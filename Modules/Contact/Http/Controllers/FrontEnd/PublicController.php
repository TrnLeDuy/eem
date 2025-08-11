<?php

namespace Modules\Contact\Http\Controllers\FrontEnd;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Repositories\CategoryRepository;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\BasePublicController;
class PublicController extends BasePublicController
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function contact(Request $request)
    {
        $products = getAllProducts();
        $categories = getAllCategories();
        $page = (object) [
            'title' => trans('contact::contacts.title.contacts'),
            'meta_title' => trans('contact::contacts.title.contacts'),
            'meta_description' => trans('contact::contacts.title.contacts')
        ];
        
        // Lấy thông tin từ URL
        $selectedType = $request->input('type');
        $selectedProductId = $request->input('product_id');
        
        return view('page.contact', compact('page', 'products', 'categories', 'selectedType', 'selectedProductId'));
    }
}
