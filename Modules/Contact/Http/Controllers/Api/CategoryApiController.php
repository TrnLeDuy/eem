<?php

namespace Modules\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contact\Entities\Category;
use Modules\Contact\Http\Requests\CreateCategoryRequest;
use Modules\Contact\Http\Requests\UpdateCategoryRequest;
use Modules\Contact\Repositories\CategoryRepository;
use Modules\Contact\Transformers\Backend\FullCategoryTransformer;
use Modules\Contact\Transformers\Backend\CategoryTransformer;
use Modules\Contact\Transformers\Backend\SmallCategoryTransformer;

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

    public function destroy(Category $categoryId)
    {
        // dd($categoryId);
        $this->categoryRepository->destroy($categoryId);
        return response()->json([
            'errors' => false,
            'message' => trans('product::categories.messages.categories deleted'),
        ]);
    }
}