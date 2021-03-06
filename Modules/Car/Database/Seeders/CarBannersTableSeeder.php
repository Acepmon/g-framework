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
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-technical-examination",
            "title" => "2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-auction",
            "title" => "3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-dream-car",
            "title" => "4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/4.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 1,
            "link" => "/about-finance",
            "title" => "5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/5.png"
        ]);

        // 2. Login Main Slider (650x650)
        factory(Banner::class, 1)->create([
            "location_id" => 2,
            "link" => "/about-introduction",
            "title" => "1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/1.png"
        ]);
        factory(Banner::class, 1)->create([
            "location_id" => 2,
            "link" => "/about-finance",
            "title" => "5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/5.png"
        ]);

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
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 5,
            "title" => "mainBottom4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mainBottom4.png"
        ]);

        // 6. Mobile Home Main Slider (640x360)
        factory(Banner::class, 1)->create([
            "location_id" => 6,
            "link" => "/about-introduction",
            "title" => "Mobile Home 1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 6,
            "link" => "/about-technical-examination",
            "title" => "Mobile Home 2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 6,
            "link" => "/about-auction",
            "title" => "Mobile Home 3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 6,
            "link" => "/about-dream-car",
            "title" => "Mobile Home 4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner4.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 6,
            "link" => "/about-finance",
            "title" => "Mobile Home 5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner5.png"
        ]);

        // 7. Mobile Mid Content Banner (640x360)
        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-introduction",
            "title" => "Mobile Mid Conten",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner.png"
        ]);
        /*
        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-introduction",
            "title" => "Mobile Mid Content 1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-technical-examination",
            "title" => "Mobile Mid Content 2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-auction",
            "title" => "Mobile Mid Content 3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-dream-car",
            "title" => "Mobile Mid Content 4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/4.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 7,
            "link" => "/about-finance",
            "title" => "Mobile Mid Content 5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/5.png"
        ]);*/

        // 8. Mobile Finance Main Slider (640x360)
        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-introduction",
            "title" => "Mobile Banner",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/mobileBanner.png"
        ]);
        /*
        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-introduction",
            "title" => "Mobile Finance 1",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/1.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-technical-examination",
            "title" => "Mobile Finance 2",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/2.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-auction",
            "title" => "Mobile Finance 3",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/3.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-dream-car",
            "title" => "Mobile Finance 4",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/4.png"
        ]);

        factory(Banner::class, 1)->create([
            "location_id" => 8,
            "link" => "/about-finance",
            "title" => "Mobile Finance 5",
            "status" => "active",
            "starts_at" => "2020-02-05 23:19:09",
            "ends_at" => "2030-02-05 23:19:09",
            "banner" => "https://www.maz.mn/storage/banners/5.png"
        ]);
        */
    }
}
