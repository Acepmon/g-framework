<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\PermissionManager;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        PermissionManager::newPermissionCrud('admin_modules_payment_payment_methods');
        PermissionManager::newPermissionCrud('admin_modules_payment_transactions');
        PermissionManager::newPermissionCrud('ajax_modules_payment_transactions');
    }
}
