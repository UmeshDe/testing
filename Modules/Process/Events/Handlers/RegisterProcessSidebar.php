<?php

namespace Modules\Process\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterProcessSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('process::process.title.name'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     'process.index'
                );
                $item->item(trans('process::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.process.product.create');
                    $item->route('admin.process.product.index');
                    $item->authorize(
                        $this->auth->hasAccess('process.products.index')
                    );
                });

                $item->item(trans('process::qualityparameters.title.qualityparameters'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.process.qualityparameter.create');
                    $item->route('admin.process.qualityparameter.index');
                    $item->authorize(
                        $this->auth->hasAccess('process.qualityparameters.index')
                    );
                });
                $item->item(trans('process::transfers.title.transfers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.process.transfer.create');
                    $item->route('admin.process.transfer.index');
                    $item->authorize(
                        $this->auth->hasAccess('process.transfers.index')
                    );
                });
            });
        });

        return $menu;
    }
}