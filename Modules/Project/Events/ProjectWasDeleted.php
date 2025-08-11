<?php

namespace Modules\Project\Events;

use Modules\Project\Entities\Project;

class ProjectWasDeleted
{
    /**
     * @var Project
     */
    public $project;

    public function __construct($project)
    {
        $this->project = $project;
    }
}
