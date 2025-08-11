<?php

namespace Modules\Contact\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterContactSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.cryperr_manager'), function (Group $group) {
            $group->item(trans('contact::contacts.title.contacts'), function (Item $item) {
                $item->icon('fa fa-envelope');
                $item->weight(8);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('contact::contacts.title.contacts'), function (Item $item) {
                    $item->icon('fa fa-envelope-o');
                    $item->weight(0);
                    $item->route('admin.contact.contact.index');
                    $item->authorize(
                        $this->auth->hasAccess('contact.contacts.index')
                    );
                });
                $item->item(trans('contact::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-tasks');
                    $item->weight(0);
                    $item->append('admin.contact.category.create');
                    $item->route('admin.contact.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('contact.categories.index')
                    );
                });
            });
        });

        return $menu;
    }
}
