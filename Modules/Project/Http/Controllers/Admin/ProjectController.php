<?php

namespace Modules\Project\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Project\Entities\Project;
use Modules\Project\Http\Requests\CreateProjectRequest;
use Modules\Project\Http\Requests\UpdateProjectRequest;
use Modules\Project\Repositories\ProjectRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProjectController extends AdminBaseController
{
    /**
     * @var ProjectRepository
     */
    private $project;

    public function __construct(ProjectRepository $project)
    {
        parent::__construct();

        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$projects = $this->project->all();

        return view('project::admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('project::admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProjectRequest $request
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $this->project->create($request->all());

        return redirect()->route('admin.project.project.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('project::projects.title.projects')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return Response
     */
    public function edit(Project $project)
    {
        return view('project::admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Project $project
     * @param  UpdateProjectRequest $request
     * @return Response
     */
    public function update(Project $project, UpdateProjectRequest $request)
    {
        $this->project->update($project, $request->all());

        return redirect()->route('admin.project.project.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('project::projects.title.projects')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        $this->project->destroy($project);

        return redirect()->route('admin.project.project.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('project::projects.title.projects')]));
    }
}
