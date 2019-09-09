<?php

use Illuminate\Database\Seeder;

class CarPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();
        $rootPath = \App\Config::where('key', 'content.pages.rootPath')->first()->value;

        $content = new \App\Content;
        $content->title = 'Car Detail';
        $content->slug = 'cars/';
        $content->type = \App\Content::TYPE_DYNAMIC;
        $content->status = \App\Content::STATUS_PUBLISHED;
        $content->visibility = \App\Content::VISIBILITY_PUBLIC;
        $content->author_id = 1;
        $content->save();

        $value = new \stdClass;
        $value->datetime = $time;
        $value->filename_changed = true;
        $value->before = $content;
        $value->after = $content;
        $value->user = \App\User::find(1);

        $content_meta = new \App\ContentMeta();
        $content_meta->content_id = $content->id;
        $content_meta->key = 'initial';
        $content_meta->value = json_encode($value);
        $content_meta->save();

        $file_content = file_get_contents(resource_path('stubs/car/car-detail.stub'));
        $file_name = $rootPath . DIRECTORY_SEPARATOR . 'car-detail' . \App\Content::NAMING_CONVENTION . $content->status . \App\Content::NAMING_CONVENTION . $time;
        $file_ext = 'blade.php';
        $file_path = $file_name . '.' . $file_ext;

        file_put_contents(base_path($file_path), $file_content);
    }
}
