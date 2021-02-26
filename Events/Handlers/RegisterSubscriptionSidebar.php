<?php

namespace Modules\Subscription\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterSubscriptionSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('subscription::subscriptions.title.subscriptions'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    $this->auth->hasAccess('subscription.subscriptions.index'), $this->auth->hasAccess('subscription.products.index')
                );
                $item->item(trans('subscription::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.subscription.product.create');
                    $item->route('admin.subscription.product.index');
                    $item->authorize(
                        $this->auth->hasAccess('subscription.products.index')
                    );
                });
                /*$item->item(trans('subscription::plans.title.plans'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.subscription.plan.create');
                    $item->route('admin.subscription.plan.index');
                    $item->authorize(
                        $this->auth->hasAccess('subscription.plans.index')
                    );
                });
                $item->item(trans('subscription::features.title.features'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.subscription.feature.create');
                    $item->route('admin.subscription.feature.index');
                    $item->authorize(
                        $this->auth->hasAccess('subscription.features.index')
                    );
                });*/
                $item->item(trans('subscription::subscriptions.title.subscriptions'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.subscription.subscription.create');
                    $item->route('admin.subscription.subscription.index');
                    $item->authorize(
                        $this->auth->hasAccess('subscription.subscriptions.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
