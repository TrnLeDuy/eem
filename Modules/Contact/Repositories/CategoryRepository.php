<?php

namespace Modules\Contact\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Core\Repositories\BaseRepository;

interface CategoryRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
    public function getAllCategories();
}
