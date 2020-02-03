<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarOptionsSafetyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $safeties = ['Цахилгаан зогсоолын тоормос' => ['metaKey' => 'optionSafetyElectricParkingBrake'], 
            'Эй Би Эс (ABS)' => ['metaKey' => 'optionSafetyABS'], 
            'Ухаалаг зогсоол : Урд' => ['metaKey' => 'optionSafetyParkingSenseFront'], 
            'Ухаалаг зогсоол : Хойд' => ['metaKey' => 'optionSafetyParkingSenseRear'], 
            'Камер : Хажуу' => ['metaKey' => 'optionSafetyCameraSide'], 
            'Камер : Хойд' => ['metaKey' => 'optionSafetyCameraRear'], 
            'Камер : Урд' => ['metaKey' => 'optionSafetyCameraFront'], 
            'Аюулгүйн дэр : Хөшигөн' => ['metaKey' => 'optionSafetyAirbagCurtains'], 
            'Аюулгүйн дэр : Хажуу' => ['metaKey' => 'optionSafetyAirbagSide'], 
            'Зорчигчын суудал' => ['metaKey' => 'optionSafetyAirbagPassengerSeat'], 
            'Аюулгүйн дэр : Жолоочийн суудал' => ['metaKey' => 'optionSafetyAirbagDriverSeat']];

        $parent = TaxonomyManager::register('Safety', 'car-options');

        foreach ($safeties as $safety => $metas) {
            TaxonomyManager::register($safety, 'car-safety', $parent->term->id, $metas);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
