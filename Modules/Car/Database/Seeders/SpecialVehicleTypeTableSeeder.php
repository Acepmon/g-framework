<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class SpecialVehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialVehicles = ['Blasthole drill rigs','Cargo Crane','Camping Car','Concrete boom pump','Concrete Mixer Truck','Dozer','Excavator','Ladder Truck','Pork Lift','Tank Lorry','Tow Truck','Tower Crane','Tractor','Wheel Loader','Бусад'];
             

        $parent = TaxonomyManager::register('Special Vehicle Type', 'car', null, ['metaKey' => 'carSubType']);

        foreach ($specialVehicles as $key => $specialVehicle) {
            TaxonomyManager::register($specialVehicle, 'special', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
