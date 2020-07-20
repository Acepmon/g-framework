<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Entities\TaxonomyManager;

class TermTaxonomyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $countries = [
            "Notification Event" => [],
            "Notification Info" => [],
            "Notification Mileage" => [],
            "Notification Other" => [],
        ];

        foreach ($countries as $term => $metas) {
            TaxonomyManager::register($term, 'notifications', null, $metas);
        }
        TaxonomyManager::register("Unread", 'unread', null, []);

        //$this->call(CountriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        //$this->call(CallCodesTableSeeder::class);

    }
}
