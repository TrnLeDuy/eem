<?php

namespace Modules\Contact\Events;

use Modules\Contact\Entities\Category;

class CategoryWasDeleted
{
    /**
     * @var Category
     */
    public $Category;

    public function __construct($Category)
    {
        $this->Category = $Category;
    }
}
