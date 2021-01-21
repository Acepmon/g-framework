<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\PermissionManager;
use App\Group;
use App\Permission;

class CarGroupPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Admin Group Permissions
        PermissionManager::attachGroupPermissions(1, Permission::where('title', 'LIKE', 'admin_modules_car%')->get());

        // Car Content Operator Group Permissions
        PermissionManager::attachGroupPermissions(Group::where('title', 'Car Content Operator')->first()->id, Permission::where('title', 'LIKE', 'admin_modules_car%')->get());
        $nonSystem = Group::where('title', 'Damoa Operator')->first()->id;
        PermissionManager::attachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_modules_car%')->get());
    }
}
