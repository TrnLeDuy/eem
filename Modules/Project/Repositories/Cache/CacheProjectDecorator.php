<?php

namespace Modules\Project\Repositories\Cache;

use Modules\Project\Repositories\ProjectRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CacheProjectDecorator extends BaseCacheDecorator implements ProjectRepository
{
    public function __construct(ProjectRepository $project)
    {
        parent::__construct();
        $this->entityName = 'project.projects';
        $this->repository = $project;
    }

    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $page = $request->get('page');
        $order = $request->get('order');
        $orderBy = $request->get('order_by');
        $perPage = $request->get('per_page');
        $search = $request->get('search');

        $key = $this->getBaseKey() . "serverPaginationFilteringFor.{$page}-{$order}-{$orderBy}-{$perPage}-{$search}";

        return $this->remember(function () use ($request) {
            return $this->repository->serverPaginationFilteringFor($request);
        }, $key);
    }

    public function getAllProjects()
    {
        $key = $this->getBaseKey() . "getAllProjects";
        return $this->remember(function () use ($key) {
            return $this->repository->getAllProjects();
        }, $key);
    }

    public function getProjectByCategory($categoryId, $s)
    {
        $key = $this->getBaseKey() . "getProjectByCategory" . $categoryId . $s;
        return $this->remember(function () use ($categoryId, $s) {
            return $this->repository->getProjectByCategory($categoryId, $s);
        }, $key);
    }

    public function getProjectRelated($categoryId, $projectId)
    {
        $key = $this->getBaseKey() . "getProjectRelated" . $categoryId . $projectId;
        return $this->remember(function () use ($categoryId, $projectId) {
            return $this->repository->getProjectRelated($categoryId, $projectId);
        }, $key);
    }

    public function getLatestProject($numbers)
    {
        $key = $this->getBaseKey() . "getLatestProject" . $numbers;
        return $this->remember(function () use ($numbers) {
            return $this->repository->getLatestProject($numbers);
        }, $key);
    }
}
