<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Content;
use App\ContentMeta;
use App\User;
use App\Group;
use App\Entities\TaxonomyManager;

class CarWannaBuyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(Content::class, 0)->create([
            'type' => 'wanna-buy',
            'status' => Content::STATUS_PUBLISHED,
            'visibility' => Content::VISIBILITY_PUBLIC,
        ])->each(function ($content) {
            $content->slug = 'wanna-buy/' . $content->slug;
            $content->save();

            $carUserRandomId = User::whereHas('groups', function ($query) {
                $query->where('type', Group::TYPE_DYNAMIC);
            })->get()->random()->id;
            $content->author_id = $carUserRandomId;
            $content->save();

            $markName = TaxonomyManager::collection('car-manufacturer')->random()->term;
            $models = TaxonomyManager::collection('car-' . \Str::kebab($markName->name));
            $content->terms()->save($markName);
            $modelName = '';
            if ($models->count() > 0) {
                $modelName = $models->random()->term;
                $content->terms()->save($modelName);
                $modelName = $modelName->name;
            }

            $content->metas()->saveMany([
                new ContentMeta(['key' => 'markName', 'value' => $markName->name ]),
                new ContentMeta(['key' => 'modelName', 'value' => $modelName]),
                new ContentMeta(['key' => 'publishedAt', 'value' => \Carbon\Carbon::now()]),
                new ContentMeta(['key' => 'priceAmountStart', 'value' => rand(100000, 5000000)]),
                new ContentMeta(['key' => 'priceAmountEnd', 'value' => rand(100000, 5000000)]),
                new ContentMeta(['key' => 'priceUnit', 'value' => '₮']),
            ]);

            // Update title by merging markName and modelName
            $content->title = \Str::startsWith($content->metaValue('modelName'), $content->metaValue('markName')) ? $content->metaValue('modelName') : $content->metaValue('markName') . ' ' . $content->metaValue('modelName');
            $content->slug = 'posts/' . $content->id;
            $content->save();
        });
    }
}
