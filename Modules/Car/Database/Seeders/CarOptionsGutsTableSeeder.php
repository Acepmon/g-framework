<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarOptionsGutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guts = ['Автомат хаалганы цоож' => ['metaKey' => 'optionGutsPowerDoorLock'], 
            'Суудал сануулагч' => ['metaKey' => 'optionGutsMemorySeatDriverSeat'], 
            'Зорчигчдын халдаг суудал ' => ['metaKey' => 'optionGutsHeatedSeatRearSeat'], 
            'Жолоочийн халдаг суудал' => ['metaKey' => 'optionGutsHeatedSeatDriverSeat'], 
            'Зорчигчдын цахилгаан суудал' => ['metaKey' => 'optionGutsElectricSeatPassengerSeat'], 
            'Жолоочийн цахилгаан суудал' => ['metaKey' => 'optionGutsElectricSeatDriverSeat'], 
            'Савхин суудал' => ['metaKey' => 'optionGutsLeatherSeat'], 
            'Залуурын удирдлага' => ['metaKey' => 'optionGutsPowerSteering'], 
            'Автомат жолоодлого' => ['metaKey' => 'optionGutsSteerRemoteControl']];

        $parent = TaxonomyManager::findTerm('Дотор байдал');

        foreach ($guts as $gut => $metas) {
            TaxonomyManager::register($gut, 'car-guts', $parent->id, $metas);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
