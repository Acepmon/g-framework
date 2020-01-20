<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\PermissionManager;
use App\Permission;

class GroupPermissionTableSeeder extends Seeder
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
        PermissionManager::attachGroupPermissions(1, Permission::where('title', 'LIKE', 'admin_modules_payment%')->get());
        PermissionManager::attachGroupPermissions(1, Permission::where('title', 'LIKE', 'ajax_modules_payment_transactions%')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'LIKE', 'ajax_modules_payment_transactions%')->get());
    }
}
