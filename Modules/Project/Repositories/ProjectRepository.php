<?php

namespace Modules\Project\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ProjectRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
    public function getAllProjects();
    public function getProjectByCategory($categoryId, $s);
    public function getProjectRelated($categoryId, $projectId);
    public function getLatestProject($numbers);
}
