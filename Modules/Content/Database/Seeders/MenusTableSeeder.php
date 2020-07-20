<?php

namespace Modules\Content\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Structure
        // [Title, Link, Icon, Module, Children[]?]

        $adminMenus = ['Admin', '/admin', '', 'Admin', [
            // Admin
            ['Dashboard', '/admin/dashboard', 'icon-statistics', 'Admin'],
            ['Changelog', '/admin/changelog', 'icon-list-unordered', 'Admin'],
            // System
            // ['System Users', '', 'icon-user-tie', 'System', [
            //     ['Administrators', '/admin/users/administrators', '', 'System'],
            //     ['Operators', '/admin/users/operators', '', 'System']
            // ]],
            ['Configurations', '', 'icon-gear', 'System', [
                ['Maintenance Mode', '/admin/configs/maintenance', '', 'System'],
                ['Base Configurations', '/admin/configs/base', '', 'System'],
                // ['System Configurations', '/admin/configs/system', '', 'System'],
                // ['Themes Configurations', '/admin/configs/themes', '', 'System'],
                // ['Plugins Configurations', '/admin/configs/plugins', '', 'System'],
                // ['Security Configurations', '/admin/configs/security', '', 'System'],
                // ['Content Configurations', '/admin/configs/contents', '', 'System']
            ]],
            // ['Plugins', '', 'icon-puzzle2', 'System', [
            //     ['Installed Plugins', '/admin/plugins', '', 'System'],
            //     ['Add New', '/admin/plugins/create', '', 'System']
            // ]],
            ['Themes', '', 'icon-brush', 'System', [
                ['Installed Themes', '/admin/themes', '', 'System'],
                ['Add New', '/admin/themes/create', '', 'System']
            ]],
            ['Backups', '/admin/backups', 'icon-database', 'System'],
            ['Logs', '/admin/logs', 'icon-archive', 'System'],
            // User Management
            ['Users', '/admin/users', 'icon-user', 'User Management', [
                ['Administrators', '/admin/users/administrators', '', 'User Management'],
                ['Operators', '/admin/users/operators', '', 'User Management'],
                ['Members', '/admin/users/', '', 'User Management'],
                ['Guests', '/admin/users/guests', '', 'User Management'],
            ]],
            ['Permissions', '/admin/permissions', 'icon-key', 'User Management'],
            ['Groups', '/admin/groups', 'icon-users2', 'User Management'],
            // Content
            ['Menus', '/admin/menus', 'icon-menu2', 'Content'],
            ['Pages', '/admin/contents?type=page', 'icon-files-empty2', 'Content'],
            ['Blog Posts', '/admin/contents?type=post', 'icon-blog', 'Content'],
            // ['Comments', '/admin/comments', 'icon-comment', 'Content'],
            ['Media & Assets', '/admin/media', 'icon-media', 'Content'],
            ['Localization', '/admin/localizations', 'icon-sphere', 'Content'],
            ['Categories', '/admin/taxonomy?taxonomy=category', 'icon-grid6', 'Content'],
            ['Tags', '/admin/taxonomy?taxonomy=tag', 'icon-price-tag2', 'Content'],
            ['Notifications', '/admin/notifications', 'icon-bubble-notification', 'Content'],
            // Banner
            ['Banners', '/admin/banners', 'icon-printer4', 'Banner'],
            ['Create Banner', '/admin/banners/create', 'icon-plus3', 'Banner']
        ]];

        $adminProfileMenus = ['Admin Profile', '/admin/profile', 'icon-user', 'Profile', [
            ['Profile', '/admin/profile', 'icon-user', 'Profile'],
            ['Pages', '/admin/profile/contents?type=page', 'icon-files-empty2', 'Profile'],
            ['Blog Posts', '/admin/profile/contents?type=page', 'icon-blog', 'Profile'],
            ['Permissions', '/admin/profile/permissions', 'icon-key', 'Profile'],
            ['Notifications', '/admin/profile/notifications', 'icon-bell2', 'Profile'],
            ['Groups', '/admin/groups', 'icon-users2', 'Profile']
        ]];

        $this->iterate([$adminMenus], 1);
        $this->iterate([$adminProfileMenus], 1);
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
