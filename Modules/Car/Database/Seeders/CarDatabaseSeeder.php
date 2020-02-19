<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CarDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CarAuthPagesTableSeeder::class);
        $this->call(CarPermissionsTableSeeder::class);
        $this->call(CarGroupsTableSeeder::class);
        $this->call(CarGroupMenuTableSeeder::class);
        $this->call(CarGroupPermissionTableSeeder::class);
        $this->call(CarUsersTableSeeder::class);
        $this->call(CarPagesTableSeeder::class);
        $this->call(CarInterestedCarsTableSeeder::class);
        $this->call(CarBannerLocationsTableSeeder::class);
        $this->call(CarBannersTableSeeder::class);
        $this->call(CarBuyPageTableSeeder::class);
        $this->call(CarSellPagesTableSeeder::class);
        $this->call(CarTaxonomyTableSeeder::class);
        $this->call(CarMenusTableSeeder::class);
        $this->call(CarRetailTableSeeder::class);
        $this->call(CarWannaBuyTableSeeder::class);
        $this->call(CarDoorCountTableSeeder::class);
        $this->call(CarContentsTableSeeder::class);
        $this->call(TruckSizesTableSeeder::class);
        $this->call(BusSizesTableSeeder::class);
        $this->call(SpecialVehicleTypeTableSeeder::class);
        $this->call(CarNewManufactureTableSeeder::class);
    }
}
