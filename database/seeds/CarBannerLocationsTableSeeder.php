<?php

use Illuminate\Database\Seeder;

class CarBannerLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [1170, 160],
            [120, 160],
            [650, 650],
            [640, 360]
        ];

        DB::table('banner_locations')->insert([
            [
                'title' => 'Home Main Slider (650x650)',
                'width' => $sizes[2][0],
                'height' => $sizes[2][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Login Main Slider (650x650)',
                'width' => $sizes[2][0],
                'height' => $sizes[2][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Finance Main Slider (650x650)',
                'width' => $sizes[2][0],
                'height' => $sizes[2][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Right Sidebar Sticky (120x160)',
                'width' => $sizes[1][0],
                'height' => $sizes[1][1],
                'type' => \App\BannerLocation::TYPE_STICKY
            ],
            [
                'title' => 'Mid Content Banner (1170x160)',
                'width' => $sizes[0][0],
                'height' => $sizes[0][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Mobile Home Main Slider (640x360)',
                'width' => $sizes[3][0],
                'height' => $sizes[3][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Mobile Mid Content Banner (640x360)',
                'width' => $sizes[3][0],
                'height' => $sizes[3][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ],
            [
                'title' => 'Mobile Finance Main Slider (640x360)',
                'width' => $sizes[3][0],
                'height' => $sizes[3][1],
                'type' => \App\BannerLocation::TYPE_SLIDER
            ]
        ]);
    }
}
