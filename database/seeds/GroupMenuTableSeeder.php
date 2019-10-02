<?php

use Illuminate\Database\Seeder;

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

        // Attach System Menus to System Operator Group
        Group::findOrFail(5)->menus()->attach(Menu::where('module', 'System')->get());

        // Attach System Menus to System Operator Group
        Group::findOrFail(5)->menus()->attach(Menu::where('module', 'User Management')->get());

        // Attach Content Menus to Content Operator Group
        Group::findOrFail(6)->menus()->attach(Menu::where('module', 'Content')->get());

        // Attach Banner Menus to Content Operator Group
        Group::findOrFail(6)->menus()->attach(Menu::where('module', 'Banner')->get());
    }
}
