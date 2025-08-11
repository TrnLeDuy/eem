<?php

namespace Modules\Project\Repositories\Eloquent;

use Modules\Project\Repositories\ProjectRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Project\Events\ProjectWasCreated;
use Modules\Project\Events\ProjectWasDeleted;
use Modules\Project\Events\ProjectWasUpdated;

class EloquentProjectRepository extends EloquentBaseRepository implements ProjectRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $projects = $this->allWithBuilder();
        
        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $projects->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
            })->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';
            $projects->orderBy($request->get('order_by'), $order);
        } else {
            $projects->orderBy('updated_at', 'desc');
        }

        return $projects->paginate($request->get('per_page', 12));
    }

    public function create($data)
    {
        $project = $this->model->create($data);
        event(new ProjectWasCreated($project, $data));
        return $project;
    }

    public function update($model, $data)
    {
        $model->update($data);
        event(new ProjectWasUpdated($model, $data));
        return $model;
    }

    public function destroy($project)
    {
        event(new ProjectWasDeleted($project));
        return $project->delete();
    }

    public function getAllProjects()
    {
        return $this->model->where('status', true)->get();
    }

    public function getProjectByCategory($categoryId, $s)
    {
        $projects = $this->model->where('status', true)->where('category_id', $categoryId);
        if ($s != null) {
            if ($s == 'l') {
                $projects->where('is_new_arrivals', true);
            }

            if ($s == 'b') {
                $projects->where('is_best_selling', true);
            }
            if ($s == 'd') {
                $projects->where('is_promotion', true);
            }

            if ($s == 'ph') {
                $projects->orderBy('price_sale', 'DESC');
            } elseif ($s = 'pl') {
                $projects->orderBy('price_sale', 'ASC');
            } else {
                $projects->orderBy('created_at', 'DESC');
            }
        }
        return $projects->paginate(12);
    }

    public function getProjectRelated($categoryId, $projectId)
    {
        return $this->model->where('status', true)
                ->whereNot('id', $projectId)
                ->where('category_id', $categoryId)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
    }

    public function getLatestProject($numbers)
    {
        return $this->model->where('status', true)->orderBy('created_at', 'DESC')->limit($numbers)->get();
    }
}
