<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colour = [
            'Хар' => ['value' => 'black'], 
            'Ясан цагаан' => ['value' => 'white-ivory'], 
            'Сувдан цагаан' => ['value' => 'white-pearl'], 
            'Мөнгөлөг' => ['value' => 'silver'], 
            'Асфалтан саарал' => ['value' => 'asphalt-gray'], 
            'Улаан' => ['value' => 'red'], 
            'Цэнхэр' => ['value' => 'blue'], 
            'Хар хөх' => ['value' => 'blue-dark'], 
            'Номин ногоон' => ['value' => 'sea'], 
            'Бор' => ['value' => 'brown'], 
            'Алтлаг бор' => ['value' => 'bronze'], 
            'Ногоон' => ['value' => 'green'], 
            'Цайвар ногоон' => ['value' => 'green-light'], 
            'Алтлаг' => ['value' => 'gold'], 
            'Зэс' => ['value' => 'copper'], 
            'Шаргал цагаан' => ['value' => 'beige']
        ];
        $parent = TaxonomyManager::register('Color', 'car', null, ['metaKey' => 'colorName']);

        foreach ($colour as $color => $metas) {
            TaxonomyManager::register($color, 'car-colors', $parent->term->id, $metas);
        }

        # Interior Color
        $interior_colour = [
            'Хар' => ['value' => 'black'],
            'Саарал' => ['value' => 'grey'],
            'Цагаан' => ['value' => 'white-ivory'],
            'Шаргал цагаан' => ['value' => 'beige']
        ];

        $parent = TaxonomyManager::register('Interior color', 'car', null, ['metaKey' => 'colorNameInterior']);

        foreach ($interior_colour as $color => $metas) {
            TaxonomyManager::register($color, 'car-interior-colors', $parent->term->id, $metas);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);

    }
}
