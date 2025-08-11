<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Product\Http\Requests\CreateProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Transformers\Backend\ProductTransformer;
use Modules\Product\Transformers\Backend\SmallProductTransformer;
use Modules\Product\Transformers\Backend\FullProductTransformer;

class ProductApiController extends Controller
{
    /**
     * @var productRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function indexServerSide(Request $request)
    {
        return ProductTransformer::collection($this->productRepository->serverPaginationFilteringFor($request));
    }

    public function store(CreateProductRequest $request)
    {
        $this->productRepository->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('product::products.messages.product created'),
        ]);
    }

    public function find(Request $request)
    {
        $productId = $request->productId;
        $product = $this->productRepository->find($productId);
        return new FullProductTransformer($product);
    }

    public function update($productId, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($productId);
        $this->productRepository->update($product, $request->all());
        return response()->json([
            'errors' => false,
            'message' => trans('product::products.messages.product updated'),
        ]);
    }

    public function destroy(Request $request)
    {
        $productId = $request->productId;
        $product = $this->productRepository->find($productId);
        $this->productRepository->destroy($product);
        return response()->json([
            'errors' => false,
            'message' => trans('product::products.messages.product deleted'),
        ]);
    }
}