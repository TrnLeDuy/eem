<?php

namespace Modules\Product\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Core\Repositories\BaseRepository;
use Illuminate\Http\Request;

interface ProductRepository extends BaseRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator;
    public function findBySlugInLocale($slug, $locale);
    public function getAllProducts();
    public function getProductRelated($categoryId, $productId);
    public function getProductByKeyword($keyword, $s, $cid, $locale);
    public function getProductByCategory($categoryId, $s);
    public function getLatestProduct($numbers);
}
