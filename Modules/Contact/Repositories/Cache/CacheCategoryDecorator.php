<?php

namespace Modules\Contact\Repositories\Cache;

use Modules\Contact\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'contact.categories';
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

    public function getAllCategories()
    {
        $key = $this->getBaseKey() . "getAllCategories";
        return $this->remember(function () use ($key) {
            return $this->repository->getAllCategories();
        }, $key);
    }
}
