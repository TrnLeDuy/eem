<?php

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
    public function getAllProductCategories();
}
