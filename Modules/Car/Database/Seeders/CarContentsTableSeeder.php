<?php

namespace Modules\Car\Database\Seeders;

use App\Content;
use App\ContentMeta;
use App\User;
use DB;
use App\TermTaxonomy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Entities\TaxonomyManager;

class CarContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $time = time();
        $rootPath = config('content.cars.rootPath');

        factory(Content::class, 1)->create(['type' => Content::TYPE_CAR])->each(function ($content) use ($time, $rootPath) {

            $content->slug = config('content.cars.containerPage') . '/' . $content->slug;
            $content->save();

            // $carUserRandomId = User::whereHas('groups', function ($query) {
            //     $query->where('type', Group::TYPE_DYNAMIC);
            // })->get()->random()->id;
            $carUserRandomId = User::all()->random()->id;
            $content->author_id = $carUserRandomId;
            $content->save();

            // Random values

            $countryName = TaxonomyManager::collection('countries')->random()->term;
            $markName = TaxonomyManager::collection('car-manufacturer')->random()->term;
            $modelName = TaxonomyManager::collection('car-' . Str::kebab($markName->name))->random()->term;
            $type = TaxonomyManager::collection('car-type')->random()->term;
            // $className = '';
            $manCount = TaxonomyManager::collection('car-mancount')->random()->term;
            $fuelType = TaxonomyManager::collection('car-fuel')->random()->term;
            $colorName = TaxonomyManager::collection('car-colors')->random()->term;
            $transmission = TaxonomyManager::collection('car-transmission')->random()->term;
            $wheelPosition = TaxonomyManager::collection('car-wheel-pos')->random()->term;
            $wheel = TaxonomyManager::collection('car-wheel')->random()->term;
            $condition = TaxonomyManager::collection('car-conditions')->random()->term;
            $colorInterior = TaxonomyManager::collection('car-colors')->random()->term;
            $colorExterior = TaxonomyManager::collection('car-colors')->random()->term;
            $doorCount = TaxonomyManager::collection('door-count')->random()->term;
            $retail = Content::where('type', 'retail')->get()->random()->id;

            // static images
            $thumbnail = asset('car-web/img/Cars/' . rand(1, 12) . '.jpg');
            $medias = [];
            $mediasLimit = rand(1, 20);
            for ($i = 0; $i < $mediasLimit; $i++) {
                $media = asset('car-web/img/Cars/' . rand(1, 12) . '.jpg');
                $meta = new ContentMeta(['key' => 'medias', 'value' => $media]);
                array_push($medias, $meta);
            }

            // Publish Types
            $publishTypes = ['free', 'premium', 'best_premium'];
            $price = rand(1, 10000) . '000';

            $content->terms()->saveMany([
                $markName,
                $modelName,
                $countryName,
                $type,
                $manCount,
                $fuelType,
                $colorName,
                $transmission,
                $wheelPosition,
                $wheel,
                $condition,
                $colorExterior,
                $colorInterior,
                $doorCount
            ]);

            // Car options
            $option_cats = TaxonomyManager::collection('car-options');
            foreach($option_cats as $option_cat) {
                $options = $option_cat->children;
                foreach($options as $option) {
                    if (rand(0, 1)) {
                        $content->terms()->save($option->term);
                    }
                }
            }

            $content->metas()->saveMany([
                new ContentMeta(['key' => 'plateNumber', 'value' => rand(1000, 9999) . \Str::random(3)]),
                new ContentMeta(['key' => 'cabinNumber', 'value' => \Str::uuid()]),
                new ContentMeta(['key' => 'className', 'value' => 'luxury']),

                new ContentMeta(['key' => 'weightAmount', 'value' => rand(1, 2000)]),
                new ContentMeta(['key' => 'weightUnit', 'value' => 'kg']),
                new ContentMeta(['key' => 'massAmount', 'value' => rand(1, 2000)]),
                new ContentMeta(['key' => 'massUnit', 'value' => 'kg']),
                new ContentMeta(['key' => 'widthAmount', 'value' => rand(1, 200)]),
                new ContentMeta(['key' => 'widthUnit', 'value' => 'cm']),
                new ContentMeta(['key' => 'heightAmount', 'value' => rand(1, 150)]),
                new ContentMeta(['key' => 'heightUnit', 'value' => 'cm']),
                new ContentMeta(['key' => 'capacityAmount', 'value' => rand(1, 5000)]),
                new ContentMeta(['key' => 'capacityUnit', 'value' => 'cc']),
                new ContentMeta(['key' => 'motorNumber', 'value' => \Str::uuid()]),
                new ContentMeta(['key' => 'axleCount', 'value' => '2']),
                new ContentMeta(['key' => 'certificateNumber', 'value' => \Str::uuid()]),
                new ContentMeta(['key' => 'importDate', 'value' => rand(1990, 2020)]),
                new ContentMeta(['key' => 'intent', 'value' => 'use']),
                new ContentMeta(['key' => 'archiveDate', 'value' => rand(1990, 2020)]),
                new ContentMeta(['key' => 'buildYear', 'value' => rand(1990, 2020)]),
                new ContentMeta(['key' => 'archiveFirstNumber', 'value' => 'A598WDY987']),
                new ContentMeta(['key' => 'lengthAmount', 'value' => '4']),
                new ContentMeta(['key' => 'lengthUnit', 'value' => 'm']),
                new ContentMeta(['key' => 'archiveNumber', 'value' => 'A598WDY987']),
                new ContentMeta(['key' => 'mileageAmount', 'value' => rand(1, 5000)]),
                new ContentMeta(['key' => 'mileageUnit', 'value' => 'km']),
                new ContentMeta(['key' => 'advantages', 'value' => 'Тамхи татаагүй']),
                new ContentMeta(['key' => 'advantages', 'value' => 'Гражинд байдаг']),
                new ContentMeta(['key' => 'advantages', 'value' => 'Өвөл зуны дугуйтай']),
                new ContentMeta(['key' => 'isSold', 'value' => rand(0, 1)]),
                new ContentMeta(['key' => 'priceAmount', 'value' => $price]),
                new ContentMeta(['key' => 'priceUnit', 'value' => '₮']),
                new ContentMeta(['key' => 'priceType', 'value' => 'Зээлээр']),
                new ContentMeta(['key' => 'thumbnail', 'value' => $thumbnail]),
                new ContentMeta(['key' => 'link', 'value' => 'https://www.youtube.com/watch?v=2RnGwkWL94I']),

                // Auction fields
                new ContentMeta(['key' => 'isAuction', 'value' => rand(0, 1)]),
                new ContentMeta(['key' => 'buyoutAmount', 'value' => '10000000']),
                new ContentMeta(['key' => 'buyoutUnit', 'value' => '₮']),
                new ContentMeta(['key' => 'startPriceAmount', 'value' => $price]),
                new ContentMeta(['key' => 'startPriceUnit', 'value' => '₮']),
                new ContentMeta(['key' => 'maxBidAmount', 'value' => '14000000']),
                new ContentMeta(['key' => 'maxBidUnit', 'value' => '₮']),
                new ContentMeta(['key' => 'startsAt', 'value' => '2019-11-15']),
                new ContentMeta(['key' => 'endsAt', 'value' => '2019-11-18']),
                new ContentMeta(['key' => 'bids', 'value' => '24']),

                // Analytical logs
                new ContentMeta(['key' => 'viewed', 'value' => rand(1, 10000)]),
                new ContentMeta(['key' => 'interested', 'value' => rand(1, 100)]),

                new ContentMeta(['key' => 'engine', 'value' => '1499 L']),
                new ContentMeta(['key' => 'chassis', 'value' => '4 WD']),
                new ContentMeta(['key' => 'speedLimitAmount', 'value' => '180']),
                new ContentMeta(['key' => 'speedLimitUnit', 'value' => 'km/h']),

                // Doctor Service Verification
                new ContentMeta(['key' => 'doctorVerified', 'value' => rand(0, 1)]),
                new ContentMeta(['key' => 'doctorVerifiedBy', 'value' => '1']),
                new ContentMeta(['key' => 'doctorVerificationRequest', 'value' => false]),
                new ContentMeta(['key' => 'doctorVerificationFile', 'value' => '']),

                // Retail
                new ContentMeta(['key' => 'retail', 'value' => $retail]),

                // Seller
                new ContentMeta(['key' => 'sellerDescription', 'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ullam, explicabo iure delectus asperiores sed aliquam provident magnam similique accusantium magni! Neque dolorum similique aliquam id recusandae aliquid nihil sit, blanditiis corporis? Odit, repudiandae recusandae. Libero rem aliquid, distinctio vel ad ab nostrum nulla repellendus modi officia eligendi officiis ducimus labore? Ad, praesentium laborum fugiat vitae doloremque qui beatae consectetur.']),

                // Diagnostic
                new ContentMeta(['key' => 'diagnosticConditionImage', 'value' => '/assets/car-web/img/retail.png']),

                // Publishing
                new ContentMeta(['key' => 'publishType', 'value' => $publishTypes[array_rand($publishTypes)]]),
                // new ContentMeta(['key' => 'publishedAt', 'value' => now()]),
                new ContentMeta(['key' => 'publishPriceAmount', 'value' => rand(10000, 50000)]),
                new ContentMeta(['key' => 'publishPriceUnit', 'value' => '₮']),
                new ContentMeta(['key' => 'publishDuration', 'value' => rand(1, 31)]),
                new ContentMeta(['key' => 'publishVerified', 'value' => rand(0, 1)]),
                new ContentMeta(['key' => 'publishVerifiedBy', 'value' => 1]),
                new ContentMeta(['key' => 'publishVerifiedAt', 'value' => now()]),
                //new ContentMeta(['key' => 'publishVerifiedEnd', 'value' => now()->addDays(rand(1, 31))]),
            ]);

            $content->metas()->saveMany($medias);

            // Update title by merging markName and modelName
            $content->title = Str::startsWith($modelName->name, $markName->name) ? $modelName->name : $markName->name . ' ' . $modelName->name;
            $content->slug = 'posts/' . $content->id;
            $content->status = Content::STATUS_PUBLISHED;
            $content->visibility = Content::VISIBILITY_PUBLIC;
            $content->save();

            $value = new \stdClass;
            $value->datetime = $time;
            $value->filename_changed = true;
            $value->before = $content;
            $value->after = $content;
            $value->user = User::find($content->author_id);

            $content_meta = new ContentMeta();
            $content_meta->content_id = $content->id;
            $content_meta->key = 'initial';
            $content_meta->value = json_encode($value);
            $content_meta->save();

            // $file_content = file_get_contents(resource_path('stubs/carPost.stub'));
            // $file_name = $rootPath . DIRECTORY_SEPARATOR . $content->slug . Content::NAMING_CONVENTION . $content->status . Content::NAMING_CONVENTION . $time;
            // $file_ext = 'blade.php';
            // $file_path = $file_name . '.' . $file_ext;

            // file_put_contents(base_path($file_path), $file_content);
        });
    }
}
