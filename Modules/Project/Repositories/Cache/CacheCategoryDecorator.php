<?php

namespace Modules\Project\Repositories\Cache;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;use Modules\Project\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'project.categories';
        $this->repository = $category;
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

    public function getCategoryMenu()
    {
        return $this->remember(function () {
            return $this->repository->getCategoryMenu();
        });
    }

    public function findCategory($categoryId)
    {
        return $this->remember(function () use ($categoryId) {
            return $this->repository->findCategory($categoryId);
        });
    }


}
