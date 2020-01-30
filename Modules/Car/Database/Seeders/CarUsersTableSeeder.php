<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\UserMeta;
use App\Group;

class CarUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(User::class)->create()->each(function ($user) {
            $carGroups = Group::where('type', Group::TYPE_DEALER)->get();
            $randomGroup = $carGroups->random();
            $randomGroupId = $randomGroup->id;

            $user->groups()->attach(3);
            // $user->groups()->attach($randomGroupId);

            $user->metas()->saveMany([
                new UserMeta(['user_id' => '4','key' => 'type', 'value' => 'Damoa']),
                new UserMeta(['user_id' => '4','key' => 'phone', 'value' => '99119922']),
            ]);
        });
    }
}
