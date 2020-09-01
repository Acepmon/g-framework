<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Menu;
use App\Term;

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

        $carMainMenus = ['Car Main', '', '', 'Car', [
            ['Нүүр', '/', '', 'Car'],
            ['Авна', '/buy', '', 'Car'],
            ['Зарна', '/sell', '', 'Car'],
            ['Лизинг', '/finance?firstPay=30', '', 'Car'],
            ['Аугцион', '/auction', '', 'Car'],
            ['Авъя', '/wishlist', '', 'Car']
        ]];
        $doctorVerified = Term::where('slug', 'batalgaazhsan')->first();
        $carTopbarMenus = ['Car Topbar', '', '', 'Car', [
            ['Бидний тухай', '/about-introduction', '', 'Car'],
            ['Үзлэгт орсон', '/buy?car-doctor-verified='.$doctorVerified->id, '', 'Car'],
            ['+Хүсэлт оруулах', '/wishlist', '', 'Car'],
            ['Төлбөртэй зарын заавар', '/manual', '', 'Car']
        ]];
        $carFooterMenus = ['Car Footer', '', '', 'Car', [
            ['Бидний тухай', '/about-introduction', '', 'Car'],
            ['Хүслийн жагсаалт', '/wishlist', '', 'Car']
        ]];
        $carProfileDropdownMenus = ['Car Profile Dropdown', '', '', 'Car', [
            ['Сонирхож буй машинууд', '/interested-car', '', 'Car'],
            ['Авах машины зар', '/interested-car-registration-alert', '', 'Car'],
            ['Зарах машины зар', '/sell-page-on-sell', '', 'Car'],
            ['Төлбөртэй зарууд', '/purchase-page-published', '', 'Car'],
            ['Данс', '/my-mileage', '', 'Car'],
            ['Мэдээлэл', '/my-notifications', '', 'Car'],
            ['Миний хуудас', '/home', '', 'Car'],
        ]];

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
