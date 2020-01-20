<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PaymentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(PaymentTransactionTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);

        $this->call(GroupMenuTableSeeder::class);
        $this->call(GroupPermissionTableSeeder::class);
    }
}
