<?php

namespace Modules\Reports\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterReportsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('reports::reportmasters.title.name'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('Production'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(1);
                    $item->append('admin.reports.reportmaster.create');
                    $item->route('admin.reports.reportmaster.index');
                    $item->authorize(
                        $this->auth->hasAccess('reports.reportmasters.index')
                    );
                });
                $item->item(trans('Packaging'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(2);
                    $item->append('admin.reports.reportmaster.create');
                    $item->route('admin.reports.reportmaster.index');
                    $item->authorize(
                        $this->auth->hasAccess('reports.reportmasters.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
