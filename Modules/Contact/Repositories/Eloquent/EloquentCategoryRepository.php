<?php

namespace Modules\Contact\Repositories\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Contact\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Contact\Events\CategoryWasCreated;
use Modules\Contact\Events\CategoryWasDeleted;
use Modules\Contact\Events\CategoryWasUpdated;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    public function create($data)
    {
        $category = $this->model->create($data);
        event(new CategoryWasCreated($category, $data));
        return $category;
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
            })->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';
            $categories->orderBy($request->get('order_by'), $order);
        } else {
            $categories->orderBy('updated_at', 'desc');
        }

        return $categories->paginate($request->get('per_page', 10));
    }

    public function getAllCategories()
    {
        $categories = $this->model->where('status', true);
        return $categories->paginate(20);
    }
}
