<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CarAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = ['Ulaanbaatar', 'Darkhan', 'Erdenet', 'Arkhangai', 'Bayan-Ulgii', 'Bayankhongor', 'Bulgan', 'Gobi-Altai', 'Gobisumber', 'Darkhan-Uul', 'Dornogobi', 'Dornod'
    , 'Dundgobi', 'Zavkhan', 'Orkhon', 'Uvurkhangai', 'Umnugobi', 'Sukhbaatar', 'Selenge', 'Tuv', 'Uvs', 'Khovd', 'Khuvsgul', 'Khentii'];

        foreach($location as &$area){
            $term_id1 = DB::table('terms')->insertGetId([
                'name' => $area,
                'slug' => $area,
            ]);
            DB::table('term_taxonomy')->insert([
                'term_id' => $term_id1,
                'taxonomy' => 'Area',
                'description' => $area,
                'parent_id' => 5,
                'count' => 0
            ]);
        }
    }
}