<?php

namespace Modules\Product\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Product\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Product\Events\CategoryWasCreated;
use Modules\Product\Events\CategoryWasDeleted;
use Modules\Product\Events\CategoryWasUpdated;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        $product = $this->model->create($data);
        event(new CategoryWasCreated($product, $data));
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
        event(new CategoryWasUpdated($model, $data));
        return $model;
    }

    public function destroy($category)
    {
        event(new CategoryWasDeleted($category));
        return $category->delete();
    }

    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $categories = $this->allWithBuilder();
        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $categories->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->orWhere('slug', 'LIKE', "%{$term}%");
            })->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';
            $categories->orderBy($request->get('order_by'), $order);
        } else {
            $categories->orderBy('created_at', 'desc');
        }

        return $categories->paginate($request->get('per_page', 10));
    }

    public function getAllProductCategories()
    {
        return $this->model->where('status', true)->get();
    }
}
