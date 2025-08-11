<?php

use Modules\Project\Repositories\CategoryRepository;
use Modules\Project\Repositories\ProjectRepository;

if (!function_exists('getAllProjects')) {
    function getAllProjects()
    {
        return app(ProjectRepository::class)->getAllProjects();
    }
}

if (!function_exists('getLatestProject')) {
    function getLatestProject($numbers)
    {
        return app(ProjectRepository::class)->getLatestProject($numbers);
    }
}

if (!function_exists('getCategoryMenu')) {
    function getCategoryMenu()
    {
        return app(CategoryRepository::class)->getCategoryMenu();
    }
}
