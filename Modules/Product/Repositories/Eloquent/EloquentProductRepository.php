<?php

namespace Modules\Product\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Product\Events\ProductWasCreated;
use Modules\Product\Events\ProductWasDeleted;
use Modules\Product\Events\ProductWasUpdated;


class EloquentProductRepository extends EloquentBaseRepository implements ProductRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $products = $this->allWithBuilder();
        
        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $products->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->where('slug' , 'LIKE', "%{$term}%");
            })->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';
            $products->orderBy($request->get('order_by'), $order);
        } else {
            $products->orderBy('updated_at', 'desc');
        }

        return $products->paginate($request->get('per_page', 10));
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        $product = $this->model->create($data);
        event(new ProductWasCreated($product, $data));
        return $product;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {
        $model->update($data);
        event(new ProductWasUpdated($model, $data));
        return $model;
    }

    public function destroy($product)
    {
        event(new ProductWasDeleted($product));
        return $product->delete();
    }

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
    public function findBySlugInLocale($slug, $locale)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug, $locale) {
                $q->where('slug', $slug);
                $q->where('locale', $locale);
            })->with('translations')->where('status', true)->first();
        }

        return $this->model->where('status', true)->where('slug', $slug)->where('locale', $locale)->first();
    }

    public function getAllProducts()
    {
        $products = $this->model->where('status', true);
        return $products->paginate(12);
    }

    public function getProductRelated($categoryId, $productId)
    {
        return $this->model->where('status', true)
                ->whereNot('id', $productId)
                ->where('category_id', $categoryId)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
    }

    public function getProductByCategory($categoryId, $s)
    {
        $products = $this->model->where('status', true)->where('category_id', $categoryId);
        if ($s != null) {
            if ($s == 'l') {
                $products->where('is_new_arrivals', true);
            }

            if ($s == 'b') {
                $products->where('is_best_selling', true);
            }
            if ($s == 'd') {
                $products->where('is_promotion', true);
            }

            if ($s == 'ph') {
                $products->orderBy('price_sale', 'DESC');
            } elseif ($s = 'pl') {
                $products->orderBy('price_sale', 'ASC');
            } else {
                $products->orderBy('created_at', 'DESC');
            }
        }
        return $products->paginate(12);
    }

    public function getProductByKeyword($keyword, $s, $cid, $locale)
    {
        $products = $this->model->whereHas('translations', function (Builder $q) use ($keyword, $locale) {
            $q->where('title', 'LIKE', '%' . $keyword . '%');
            $q->where('locale', $locale);
        })->with('translations')->where('status', true);
        if ($cid != null && $cid != "") {
            $products->where('category_id', $cid);
        }
        if ($s != null) {
            if ($s == 'l') {
                $products->where('is_new_arrivals', true);
            }

            if ($s == 'b') {
                $products->where('is_best_selling', true);
            }
            if ($s == 'd') {
                $products->where('is_promotion', true);
            }

            if ($s == 'ph') {
                $products->orderBy('price_sale', 'DESC');
            } elseif ($s = 'pl') {
                $products->orderBy('price_sale', 'ASC');
            } else {
                $products->orderBy('created_at', 'DESC');
            }
        }
        return $products->paginate(12);
    }

    public function getLatestProduct($numbers)
    {
        return $this->model->where('status', true)->orderBy('created_at', 'DESC')->limit($numbers)->get();
    }
}
