<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Group;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('users') && Schema::hasTable('groups')) {
            // Attach Admin Group to Admin User
            User::where('username', 'admin')->first()->groups()->attach(Group::where('title', 'Administrator')->get());

            // Attach Operator, System Operator Group to System Operator User
            User::where('username', 'system')->first()->groups()->attach(Group::where('title', 'Operator')->get());
            User::where('username', 'system')->first()->groups()->attach(Group::where('title', 'System Operator')->get());

            // Attach Operator, Content Operator Group to Content Operator User
            User::where('username', 'content')->first()->groups()->attach(Group::where('title', 'Operator')->get());
            User::where('username', 'content')->first()->groups()->attach(Group::where('title', 'Content Operator')->get());

            // Custom User
            User::where('username', 'damoa')->first()->groups()->attach(Group::where('title', 'Damoa')->get());
            User::where('username', 'damoa')->first()->groups()->attach(Group::where('title', 'Member')->get());

            // Attach Admin Group to Admin User
            User::where('username', 'damoaAdmin')->first()->groups()->attach(Group::where('title', 'Operator')->get());
            User::where('username', 'damoaAdmin')->first()->groups()->attach(Group::where('title', 'Damoa Operator')->get());
        }
    }
}
