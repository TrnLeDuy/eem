<?php

namespace Modules\Project\Events;

use Modules\Media\Contracts\StoringMedia;
use Modules\Project\Entities\Project;

class ProjectWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Project
     */
    public $project;

    public function __construct(Project $project, array $data)
    {
        $this->data = $data;
        $this->project = $project;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->project;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
