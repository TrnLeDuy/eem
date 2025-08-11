<?php

namespace Modules\Project\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Project\Repositories\ProjectRepository;
use Modules\Project\Repositories\CategoryRepository;

class PublicController extends BasePublicController
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    private $categoryRepository;

    public function __construct(ProjectRepository $projectRepository, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function detail($slug, Request $request)
    {
        $project = $this->projectRepository->findBySlug($slug);
        $image = $project->getAvatar();
        if ($project && $project->status == true) {
            $category = $this->categoryRepository->findByAttributes(['id' => $project->category_id]);
            $relatedProjects = $this->projectRepository->getProjectRelated($project->category_id, $project->id);
            $page = (object) [
                'title' => $project->title,
                'meta_title' => $project->title,
                'meta_description' => $project->title
            ];
            return view('projects.detail', compact('project', 'category', 'page', 'image', 'relatedProjects'));
        } else {
            abort(404);
        }
    }
}




