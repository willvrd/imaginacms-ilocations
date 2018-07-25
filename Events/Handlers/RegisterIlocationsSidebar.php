<?php

namespace Modules\Ilocations\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIlocationsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('ilocations::ilocations.title.ilocations'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('ilocations::countries.title.countries'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ilocations.country.create');
                    $item->route('admin.ilocations.country.index');
                    $item->authorize(
                        $this->auth->hasAccess('ilocations.countries.index')
                    );
                });
                $item->item(trans('ilocations::provinces.title.provinces'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ilocations.province.create');
                    $item->route('admin.ilocations.province.index');
                    $item->authorize(
                        $this->auth->hasAccess('ilocations.provinces.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
