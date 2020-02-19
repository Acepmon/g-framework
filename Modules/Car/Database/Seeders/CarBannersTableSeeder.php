<?php

namespace Modules\Car\Database\Seeders;

use App\Banner;
use App\BannerLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CarBannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $url = "https://via.placeholder.com";

        // 1. Home Main Slider (650x650)
        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-introduction",
            "title" => "1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-technical-examination",
            "title" => "2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-auction",
            "title" => "3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-dream-car",
            "title" => "4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/4.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-finance",
            "title" => "5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/5.png"
        ]);

        // 2. Login Main Slider (650x650)
        factory(Banner::class, 3)->create([
            "location_id" => 2,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(2)->width . "x" . BannerLocation::find(2)->height;
            $banner->save();
        });

        // 3. Finance Main Slider (650x650)
        factory(Banner::class, 3)->create([
            "location_id" => 3,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(3)->width . "x" . BannerLocation::find(3)->height;
            $banner->save();
        });

        // 4. Right Sidebar Sticky (120x160)
        factory(Banner::class, 2)->create([
            "location_id" => 4,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(4)->width . "x" . BannerLocation::find(4)->height;
            $banner->save();
        });

        // 5. Mid Content Banner (1170x160)

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2021-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom4.png"
        ]);

        // 6. Mobile Home Main Slider (640x360)
        factory(Banner::class, 10)->create([
            "location_id" => 6,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(6)->width . "x" . BannerLocation::find(6)->height;
            $banner->save();
        });

        // 7. Mobile Mid Content Banner (640x360)
        factory(Banner::class, 10)->create([
            "location_id" => 7,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(7)->width . "x" . BannerLocation::find(7)->height;
            $banner->save();
        });

        // 8. Mobile Finance Main Slider (640x360)
        factory(Banner::class, 10)->create([
            "location_id" => 8,
        ])->each(function ($banner) use ($url) {
            $banner->banner = $url . "/" . BannerLocation::find(8)->width . "x" . BannerLocation::find(8)->height;
            $banner->save();
        });
    }
}
