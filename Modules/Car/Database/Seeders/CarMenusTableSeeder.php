<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Menu;

class CarMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Structure
        // [Title, Link, Icon, Module, Children[]?]

        $adminMenus = [
            // Car Management
            ['Add Car', '/admin/modules/car/create', 'icon-plus3', 'Car'],
            ['Cars', '/admin/modules/car', 'icon-car', 'Car', [
                ['Best Premium', '/admin/modules/car/best_premium', '', 'Car'],
                ['Premium', '/admin/modules/car/premium', '', 'Car'],
                ['Free', '/admin/modules/car/free', '', 'Car']
            ]],
            ['Auction Cars', '/admin/modules/car/auction', 'icon-hammer2', 'Car'],
            ['Verification Requests', '/admin/modules/car/verifications', 'icon-clipboard2', 'Car'],
            ['Loan Check', '/admin/modules/car/loan-check', 'icon-clipboard2', 'Car'],
            ['Car Options', '/admin/modules/car/options', 'icon-cog', 'Car'],
            ['Wishlist', '/admin/modules/car/wishlist', 'icon-star-empty3', 'Car'],
        ];
        $carMainMenus = ['Car Main', '', '', 'Car', [
            ['Нүүр', '/', '', 'Car'],
            ['Авна', '/buy', '', 'Car'],
            ['Зарна', '/sell', '', 'Car'],
            ['Лизинг', '/finance?monthlyPrice=500000&firstPay=20&financeMonth=6&priceAmount=4590104&sort=updated_at', '', 'Car'],
            ['Аугцион', '/auction', '', 'Car'],
            ['Авъя', '/wishlist', '', 'Car']
        ]];
        $carTopbarMenus = ['Car Topbar', '', '', 'Car', [
            ['Бидний тухай', '/about-introduction', '', 'Car'],
            ['Үзлэгт орсон', '/search?doctorVerified=1', '', 'Car'],
            ['+Хүсэлт оруулах', '/wishlist', '', 'Car'],
            ['Төлбөртэй зарын заарав', '/', '', 'Car']
        ]];
        $carFooterMenus = ['Car Footer', '', '', 'Car', [
            ['Бидний тухай', '/about-introduction', '', 'Car'],
            ['Хүслийн жагсаалт', '/wishlist', '', 'Car']
        ]];
        $carProfileDropdownMenus = ['Car Profile Dropdown', '', '', 'Car', [
            ['Сонирхож буй машинууд', '/interested-car', '', 'Car'],
            ['Миний оруулсан зар', '/interested-car-registration-alert', '', 'Car'],
            ['Зарах хүсэлтүүд', '/sell-page-on-sell', '', 'Car'],
            ['Төлбөрийн хүсэлтүүд', '/purchase-page-published', '', 'Car'],
            ['Гүйлт', '/my-mileage', '', 'Car'],
            ['Миний хуудас', '/home', '', 'Car'],
        ]];

        $this->iterate($adminMenus, 2, 1);
        $this->iterate([
            $carMainMenus,
            $carTopbarMenus,
            $carFooterMenus,
            $carProfileDropdownMenus,
        ], 1);
    }

    private function iterate($array, $sublevel, $parent = null) {
        for ($i=0; $i < count($array); $i++) {

            $order = $i + 1;

            if (isset($parent)) {
                $order = Menu::where('parent_id', $parent)->count() + 1;
            }

            $menu = $this->insertMenu($array[$i][0], $array[$i][1], $array[$i][2], $array[$i][3], $sublevel, $order, $parent);
            if (array_key_exists(4, $array[$i]) && count($array[$i][4]) > 0) {
                $this->iterate($array[$i][4], $sublevel + 1, $menu->id);
            }
        }
    }

    private function insertMenu($title, $link, $icon, $module, $sublevel, $order, $parent = null) {
        $menu = new Menu();
        $menu->title = $title;
        $menu->link = $link;
        $menu->icon = $icon;
        $menu->module = $module;
        $menu->sublevel = $sublevel;
        $menu->order = $order;
        $menu->parent_id = $parent;
        $menu->save();

        return $menu;
    }
}
