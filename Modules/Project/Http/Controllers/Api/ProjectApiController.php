<?php

namespace Modules\Project\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Project\Http\Requests\CreateProjectRequest;
use Modules\Project\Http\Requests\UpdateProjectRequest;
use Modules\Project\Repositories\ProjectRepository;
use Modules\Project\Transformers\Backend\ProjectTransformer;
use Modules\Project\Transformers\Backend\SmallProjectTransformer;
use Modules\Project\Transformers\Backend\FullProjectTransformer;

class ProjectApiController extends Controller
{
    /**
     * @var projectRepository
     */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function indexServerSide(Request $request)
    {
        return ProjectTransformer::collection($this->projectRepository->serverPaginationFilteringFor($request));
    }

    public function store(CreateProjectRequest $request)
    {
        $data = $this->projectRepository->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('project::projects.messages.projects created'),
            'data' => $data
        ]);
    }

    public function find(Request $request)
    {
        $projectId = $request->projectId;
        $project = $this->projectRepository->find($projectId);
        return new FullProjectTransformer($project);
    }

    public function update($projectId, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($projectId);
        $this->projectRepository->update($project, $request->all());
        return response()->json([
            'errors' => false,
            'message' => trans('project::projects.messages.projects updated'),
        ]);
    }

    public function destroy($projectId)
    {
        $project = $this->projectRepository->find($projectId);
        $this->projectRepository->destroy($project);
        return response()->json([
            'errors' => false,
            'message' => trans('project::projects.messages.projects deleted'),
        ]);
    }
}



