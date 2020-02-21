<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarOptionsConvenienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conveniences = [
            'Хар хайрцаг' => ['metaKey' => 'optionConvenienceBlackBox'], 
            'Мэдрэгч : Хойд' => ['metaKey' => 'optionConvenienceBlinderRear'], 
            'AV хяналт : Хойд' => ['metaKey' => 'optionConvenienceAVMonitorRear'], 
            'AV хяналт : Урд' => ['metaKey' => 'optionConvenienceAVMonitorFront'], 
            'Бороо мэдрэгч' => ['metaKey' => 'optionConvenienceRainSenser'], 
            'Авто гэрэл' => ['metaKey' => 'optionConvenienceAutoLight'], 
            'Блютүүт' => ['metaKey' => 'optionConvenienceBluetooth'], 
            'AUX терминал' => ['metaKey' => 'optionConvenienceAUXTerminal'], 
            'USB терминал' => ['metaKey' => 'optionConvenienceUSBTerminal'], 
            'Чиглүүлэгч' => ['metaKey' => 'optionConvenienceNavigation'], 
            'Сиди тоглуулагч' => ['metaKey' => 'optionConvenienceCDPlayer'], 
            'Автомат цонх' => ['metaKey' => 'optionConveniencePowerWindow'], 
            'Авто агааржуулагч' => ['metaKey' => 'optionConvenienceAutoAirCondition'], 
            'Хурдны удирдлага' => ['metaKey' => 'optionConvenienceCruiseControl'], 
            'Ухаалаг түлхүүр' => ['metaKey' => 'optionConvenienceSmartKey']];

        $parent = TaxonomyManager::findTerm('Тав тух');

        foreach ($conveniences as $convenience => $metas) {
            TaxonomyManager::register($convenience, 'car-convenience', $parent->id, $metas);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
