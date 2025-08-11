<?php

namespace Modules\Project\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface CategoryRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
    public function getCategoryMenu();
    public function findCategory($categoryId);
}
