<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\CreateCategoryRequest;
use Modules\Product\Http\Requests\UpdateCategoryRequest;
use Modules\Product\Repositories\CategoryRepository;
use Modules\Product\Transformers\Backend\CategoryTransformer;
use Modules\Product\Transformers\Backend\FullCategoryTransformer;
use Modules\Product\Transformers\Backend\SmallCategoryTransformer;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * @var categoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return SmallCategoryTransformer::collection($this->categoryRepository->all());
    }

    public function indexServerSide(Request $request)
    {
        return CategoryTransformer::collection($this->categoryRepository->serverPaginationFilteringFor($request));
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $this->categoryRepository->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('product::categories.messages.categories created'),
            'data' => $data
        ]);
    }

    public function find(Request $request)
    {
        $categoryId = $request->categoryId;
        $category = $this->categoryRepository->find($categoryId);
        return new FullCategoryTransformer($category);
    }

    public function update($categoryId, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($categoryId);
        $this->categoryRepository->update($category, $request->all());
        return response()->json([
            'errors' => false,
            'message' => trans('product::categories.messages.categories updated'),
        ]);
    }

    public function destroy($categoryId)    {
        $category = $this->categoryRepository->find($categoryId);
        $this->categoryRepository->destroy($category);
        return response()->json([
            'errors' => false,
            'message' => trans('product::categories.messages.categories deleted'),
        ]);
    }
}