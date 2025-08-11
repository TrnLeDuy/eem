<?php

use Modules\Contact\Repositories\CategoryRepository;

if (!function_exists('getAllCategories')) {
    function getAllCategories()
    {
        return app(CategoryRepository::class)->getAllCategories();
    }
}