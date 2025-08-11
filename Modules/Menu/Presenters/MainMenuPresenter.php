<?php

namespace Modules\Menu\Presenters;

use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Menu\MenuItem;
use Modules\Menu\Presenters\Presenter;

class MainMenuPresenter extends Presenter
{
    public function setLocale($item)
    {
        if (Str::startsWith($item->url, 'http')) {
            return;
        }
        if (LaravelLocalization::hideDefaultLocaleInURL() === false) {
            $item->url = locale() . '/' . preg_replace('%^/?' . locale() . '/%', '$1', $item->url);
        }
    }
    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL . '<ul class=" nav navbar-nav">' . PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return PHP_EOL . '</ul>' . PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        $this->setLocale($item);

        return '<li class="nav-item ' . $this->getActiveState($item) . '"><a aria-current="page" href="' . $item->getUrl() . '" ' . $item->getAttributes() . '>' . $item->title . $item->getIcon() . '</a></li>' . PHP_EOL;
    }
    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = 'active')
    {
        $currentUrl = request()->url();
        $itemUrl = $item->getUrl();
        $homepageSlugUrl = url('/trang-chu');
        $rootUrl = url('/');

        if (($currentUrl === $rootUrl || $currentUrl === $homepageSlugUrl) && $itemUrl === $homepageSlugUrl) {
            return $state;
        }

        if (Str::startsWith($currentUrl, $itemUrl)) {
            return $state;
        }

        if ($item->isActive()) {
            return $state;
        }

        // if (Str::startsWith($currentUrl, url('/danh-muc')) && $itemUrl === url('/san-pham')) {
        //     return $state;
        // }

        // if (Str::startsWith($currentUrl, url('/hang-muc')) && $itemUrl === url('/san-pham')) {
        //     return $state;
        // }

        return null;
    }
}
