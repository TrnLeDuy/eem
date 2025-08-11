<?php

namespace Modules\Product\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\CategoryRepository;
use Modules\Customer\Repositories\CustomerRepository;

class PublicController extends BasePublicController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    private $categoryRepository;
    private $customerRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getProductByCategory(Request $request, $slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        if ($category && $category->status == true) {
            $s = $request->s;
            $products = $this->productRepository->getProductByCategory($category->id, $s);
            $page = (object) [
                'title' => $category->title,
                'meta_title' => $category->title,
                'meta_description' => $category->title
            ];
            $categories = getAllProductCategories();
            return view('page.product', compact('category', 'products', 's', 'page', 'categories'));
        } else {
            abort(404);
        }
    }

    public function detail($slug, Request $request)
    {
        $product = $this->productRepository->findBySlug($slug);
        if ($product && $product->status == true) {
            $category = $this->categoryRepository->findByAttributes(['id' => $product->category_id]);
            $product_seen = session('product_seen');
            $productImage = $product->getAvatar();
            $productSlideImages = $product->getImages();
            if (is_array($product_seen)) {
                if (!in_array($product->id, $product_seen)) {
                    session()->push('product_seen', $product->id);
                }
            } else {
                session()->forget('product_seen');
                session()->push('product_seen', $product->id);
            }
            $productRelated = $this->productRepository->getProductRelated($category->id, $product->id);
            return view('products.detail', compact('product', 'category', 'productRelated', 'productImage', 'productSlideImages'));
        } else {
            abort(404);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $s = $request->s;
        $cid = $request->cid;
        $param = ['keyword' => $keyword];
        if ($cid != null && $cid != "") {
            $param['cid'] = $cid;
        }
        $url = route('fe.product.product.search', $param);
        $categories = getAllProductCategories();
        $products = $this->productRepository->getProductByKeyword($keyword, $s, $cid, locale());
        $page = (object) [
            'title' => trans('product::products.title.products'),
            'meta_title' => trans('product::products.title.products'),
            'meta_description' => trans('product::products.title.products')
        ];
        return view('page.product', compact('products', 'keyword', 's', 'url', 'page', 'categories'));
    }
}
