<?php

use Modules\Product\Repositories\CategoryRepository;
use Modules\Product\Repositories\ProductRepository;

if (!function_exists('getAllProducts')) {
    function getAllProducts()
    {
        return app(ProductRepository::class)->getAllProducts();
    }
}

if (!function_exists('getAllProductCategories')) {
    function getAllProductCategories()
    {
        return app(CategoryRepository::class)->getAllProductCategories();
    }
}

if (!function_exists('getLatestProduct')) {
    function getLatestProduct($numbers)
    {
        return app(ProductRepository::class)->getLatestProduct($numbers);
    }
}

if (!function_exists('calPercent')) {
    function calPercent($price, $price2)
    {
        $num = ($price2 / $price) * 100;
        return ceil(100 - $num);
    }
}
