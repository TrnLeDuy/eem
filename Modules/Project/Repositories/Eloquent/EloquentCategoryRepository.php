<?php

namespace Modules\Project\Repositories\Eloquent;

use Modules\Project\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Project\Events\CategoryWasCreated;
use Modules\Project\Events\CategoryWasDeleted;
use Modules\Project\Events\CategoryWasUpdated;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
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
            $categories->orderBy('created_at', 'desc');
        }

        return $categories->paginate($request->get('per_page', 10));
    }

    public function create($data)
    {
        $category = $this->model->create($data);
        event(new CategoryWasCreated($category, $data));
        return $category;
    }

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

    public function getCategoryMenu()
    {
        return $this->model
            ->where('show_menu', true)
            ->where('status', true)
            ->withCount([
                'projects' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->get();
    }

    public function findCategory($categoryId)
    {
        return $this->model->where('id', '!=', $categoryId)->where('status', true)->get();
    }



}
