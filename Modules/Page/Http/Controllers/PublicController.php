<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Page\Entities\Page;
use Modules\Page\Repositories\PageRepository;
use Modules\Page\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $page;
    /**
     * @var Application
     */
    private $app;

    private $postCategory;

    private $disabledPage = false;

    public function __construct(PageRepository $page, CategoryRepository $postCategory, Application $app)
    {
        parent::__construct();
        $this->page = $page;
        $this->postCategory = $postCategory;
        $this->app = $app;
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function uri($slug)
    {
        $page = $this->findPageForSlug($slug);

        if ($page && $page->is_home == true) {
            return $this->homepage();
        }

        $this->throw404IfNotFound($page);

        $currentTranslatedPage = $page->getTranslation(locale());
        if ($slug !== $currentTranslatedPage->slug) {
            return redirect()->to($currentTranslatedPage->locale . '/' . $currentTranslatedPage->slug, 301);
        }

        $template = $page->type == "post" ? $this->getTemplateForPost($page) : $this->getTemplateForPage($page);
        // $posts = $this->page->findPageByCategory(4);
        if ($template == "page.blogs.blogs") {
            $categories = $this->postCategory->getAllCategory();
            // dd($categories);
            $blogs = getAllBlogs();
            $tags = Page::allTags()->with('translations')->get();
            $latestBlogs = $this->page->getLatestBlogs(3);

            $this->addAlternateUrls($this->getAlternateMetaData($page));

            return view($template, compact('page', 'blogs', 'categories', 'latestBlogs', 'tags'));
        }

        if ($template == "post.default") {
            $latestBlogs = $this->page->getLatestBlogs(3);
            $relatePosts = $this->page->getRelatePost($page->id, 3);
            $categories = $this->postCategory->getAllCategory();
            $this->addAlternateUrls($this->getAlternateMetaData($page));
            return view($template, compact('page', 'latestBlogs', 'relatePosts', 'categories'));
        }

        if ($template == "page.product") {
            $products = getAllProducts();
            $categories = getAllProductCategories();
            return view($template, compact('page', 'products', 'categories'));
        }

        if ($template == "page.project") {
            $projects = getAllProjects();
            $categories = getCategoryMenu();
            return view($template, compact('page', 'projects', 'categories'));
        }

        if ($template == "page.about-us") {
            $projects = getLatestProject(5);
            $products = getLatestProduct(5);
            return view($template, compact('page', 'projects', 'products'));
        }
        $this->addAlternateUrls($this->getAlternateMetaData($page));
        return view($template, compact('page'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function homepage()
    {

        $page = $this->page->findHomepage();
        $latestBlogs = $this->page->getLatestBlogs(3);
        $projects = getLatestProject(5);
        $products = getLatestProduct(5);
        $this->throw404IfNotFound($page);
        $template = $this->getTemplateForPage($page);
        $this->addAlternateUrls($this->getAlternateMetaData($page));

        return view($template, compact('page', 'latestBlogs', 'projects', 'products'));
    }

    /**
     * Find a page for the given slug.
     * The slug can be a 'composed' slug via the Menu
     * @param string $slug
     * @return Page
     */
    private function findPageForSlug($slug)
    {
        $menuItem = app(MenuItemRepository::class)->findByUriInLanguage($slug, locale());

        if ($menuItem) {
            return $this->page->find($menuItem->page_id);
        }

        return $this->page->findBySlug($slug);
    }

    /**
     * Return the template for the given page
     * or the default template if none found
     * @param $page
     * @return string
     */
    private function getTemplateForPage($page)
    {
        return (view()->exists($page->template)) ? $page->template : 'page.default';
    }

    private function getTemplateForPost($post)
    {
        return (view()->exists($post->template)) ? $post->template : 'post.default';
    }

    /**
     * Throw a 404 error page if the given page is not found or draft
     * @param $page
     */
    private function throw404IfNotFound($page)
    {
        if (null === $page || $page->status === $this->disabledPage) {
            $this->app->abort('404');
        }
    }

    /**
     * Create a key=>value array for alternate links
     *
     * @param $page
     *
     * @return array
     */
    private function getAlternateMetaData($page)
    {
        $translations = $page->getTranslationsArray();

        $alternate = [];
        foreach ($translations as $locale => $data) {
            $alternate[$locale] = $data['slug'];
        }

        return $alternate;
    }

    /**
     * Find a post for the given slug.
     * The slug can be a 'composed' slug via the Menu
     * @param string $slug
     * @return Blog
     */
    public function getBlogsByCategory($slug)
    {
        $category = $this->postCategory->findBySlug($slug);
        $categories = $this->postCategory->getAllCategory();
        $tags = Page::allTags()->with('translations')->get();
        $blogs = $this->page->findPageByCategory($category->id);
        $latestBlogs = $this->page->getLatestBlogs(3);
        $page = (object) [
            'title' => $category->title,
            'meta_title' => $category->title,
            'meta_description' => $category->title
        ];

        return view('page.blogs.blogs', compact('page', 'category', 'blogs', 'categories', 'latestBlogs', 'tags'));
    }

    public function search(Request $request)
    {
        $query = $request->input('request'); // Thay vì 'query', sử dụng 'request' để khớp với tên input trong form
        $categories = $this->postCategory->getAllCategory();
        $blogs = $this->page->search($query, 10);
        $latestBlogs = $this->page->getLatestBlogs(3);
        $page = (object) [
            'title' => trans('page::posts.search.title') . ' ' . $query,
            'meta_title' => trans('page::posts.search.meta_title') . ' ' . $query,
            'meta_description' => trans('page::posts.search.meta_description') . ' ' . $query,
        ];

        return view('page.blogs.blogs', compact('page', 'blogs', 'categories', 'latestBlogs', 'query'));
    }

    public function getPostsByTag($slug)
    {
        $tag = app('Modules\Tag\Repositories\TagRepository')->findBySlug($slug);
        
        if (!$tag) {
            return abort(404);
        }
        
        $blogs = $this->page->findByTag($tag->id)
            ->whereHas('translations', function ($query) {
                $query->where('status', 1);
            })
            ->where('type', 'post')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $latestBlogs = $this->page->getLatestBlogs(3);
        $categories = $this->postCategory->getAllCategory();
        $tags = Page::allTags()->with('translations')->get();
        
        $page = new \stdClass();
        $page->title = $tag->translate(locale())->name;
        $page->meta_title = $tag->translate(locale())->name;
        $page->meta_description = "Posts tagged with {$tag->translate(locale())->name}";
        
        return view('page.blogs.blogs', compact('page', 'blogs', 'latestBlogs', 'categories', 'tags'));
    }
}
