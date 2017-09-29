<?php

namespace Modules\Admin\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterAdminSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('admin::admin.title.name'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    'admin.admin.module.index'
                );
                $item->item(trans('admin::approvalnumbers.title.approvalnumbers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.approvalnumber.create');
                    $item->route('admin.admin.approvalnumber.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.approvalnumbers.index')
                    );
                });
                $item->item(trans('admin::bagcolors.title.bagcolors'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.bagcolor.create');
                    $item->route('admin.admin.bagcolor.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.bagcolors.index')
                    );
                });
                $item->item(trans('admin::cartontypes.title.cartontypes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.cartontype.create');
                    $item->route('admin.admin.cartontype.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.cartontypes.index')
                    );
                });
                $item->item(trans('admin::codemasters.title.codemasters'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.codemaster.create');
                    $item->route('admin.admin.codemaster.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.codemasters.index')
                    );
                });
                $item->item(trans('admin::departments.title.departments'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.department.create');
                    $item->route('admin.admin.department.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.departments.index')
                    );
                });
                $item->item(trans('admin::employees.title.employees'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.employee.create');
                    $item->route('admin.admin.employee.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.employees.index')
                    );
                });
                $item->item(trans('admin::fishtypes.title.fishtypes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.fishtype.create');
                    $item->route('admin.admin.fishtype.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.fishtypes.index')
                    );
                });
                $item->item(trans('admin::grades.title.grades'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.grade.create');
                    $item->route('admin.admin.grade.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.grades.index')
                    );
                });
                $item->item(trans('admin::kinds.title.kinds'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.kind.create');
                    $item->route('admin.admin.kind.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.kinds.index')
                    );
                });
                $item->item(trans('admin::locations.title.locations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.location.create');
                    $item->route('admin.admin.location.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.locations.index')
                    );
                });
                $item->item(trans('admin::designations.title.designations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.admin.designation.create');
                    $item->route('admin.admin.designation.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.designations.index')
                    );
                });
// append











            });
        });

        return $menu;
    }
}
