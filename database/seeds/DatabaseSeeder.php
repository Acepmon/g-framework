<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run System Module Seeder
        if (env('SEED_SYSTEM_MODULE', true)) {
            $this->call(Modules\System\Database\Seeders\SystemDatabaseSeeder::class);
        }

        // Run Content Module Seeder
        if (env('SEED_CONTENT_MODULE', true)) {
            $this->call(Modules\Content\Database\Seeders\ContentDatabaseSeeder::class);
        }

        // Run Payment Module Seeder
        if (env('SEED_PAYMENT_MODULE', true)) {
            $this->call(Modules\Payment\Database\Seeders\PaymentDatabaseSeeder::class);
        }

        // Run Car Module Seeder
        if (env('SEED_CAR_MODULE', true)) {
            $this->call(Modules\Car\Database\Seeders\CarDatabaseSeeder::class);
        }
    }
}
