<?php

namespace Modules\Project\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterProjectSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('project::projects.title.projects'), function (Item $item) {
                $item->icon('fa fa-globe');
                $item->weight(9);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('project::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-gg');
                    $item->weight(0);
                    $item->append('admin.project.category.create');
                    $item->route('admin.project.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('project.categories.index')
                    );
                });
                $item->item(trans('project::projects.title.projects'), function (Item $item) {
                    $item->icon('fa fa-hdd-o');
                    $item->weight(0);
                    $item->append('admin.project.project.create');
                    $item->route('admin.project.project.index');
                    $item->authorize(
                        $this->auth->hasAccess('project.projects.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
