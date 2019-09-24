<?php

namespace Modules\Auction\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuctionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AuctionMenusTableSeeder::class);
        $this->call(AuctionGroupMenuTableSeeder::class);
    }
}