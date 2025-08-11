<?php

namespace Modules\Project\Events;

use Modules\Project\Entities\Category;

class CategoryWasDeleted
{
    /**
     * @var Category
     */
    public $category;

    public function __construct($category)
    {
        $this->category = $category;
    }
}
