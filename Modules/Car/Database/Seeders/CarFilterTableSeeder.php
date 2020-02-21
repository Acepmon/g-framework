<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarFilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaxonomyManager::register('Хувь хүн', 'car-seller', null, [
            'metaKey' => 'seller'
        ]);
        TaxonomyManager::register('Борлуулагч', 'car-seller', null, [
            'metaKey' => 'seller'
        ]);
        TaxonomyManager::register('Баталгаажсан', 'car-doctor-verified', null, [
            'metaKey' => 'doctorVerified'
        ]);
        TaxonomyManager::register('Баталгаажаагүй', 'car-doctor-verified', null, [
            'metaKey' => 'doctorVerified'
        ]);
    }
}
