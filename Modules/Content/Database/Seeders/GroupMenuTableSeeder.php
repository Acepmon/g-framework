<?php

namespace Modules\Content\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Group;
use App\Menu;

class GroupMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Attach All Menus to Administrator Group
        Group::findOrFail(1)->menus()->attach(Menu::all());

        // Attach Admin menus to Operator Group
        Group::findOrFail(2)->menus()->attach(Menu::where('module', 'Admin')->get());

        // Attach Admin Profile menus to Operator Group
        Group::findOrFail(2)->menus()->attach(Menu::where('module', 'Profile')->get());

        // Attach System Menus to System Operator Group
        Group::findOrFail(5)->menus()->attach(Menu::where('module', 'System')->get());

        // Attach System Menus to System Operator Group
        Group::findOrFail(5)->menus()->attach(Menu::where('module', 'User Management')->get());

        // Attach Content Menus to Content Operator Group
        Group::findOrFail(6)->menus()->attach(Menu::where('module', 'Content')->get());

        // Attach Banner Menus to Content Operator Group
        Group::findOrFail(6)->menus()->attach(Menu::where('module', 'Banner')->get());

        // Attach Banner Menus to Content Operator Group
        Group::findOrFail(8)->menus()->attach(Menu::where('module', 'Car')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('module', 'User Management')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('module', 'Payment')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('module', 'Banner')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('title', 'Media & Assets')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('title', 'Notifications')->get());
        Group::findOrFail(8)->menus()->attach(Menu::where('title', 'Profile')->get());
    }
}
