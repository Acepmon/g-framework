<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('users')) {
            $users = [
                // Super Admin
                [
                    'username' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('admin123'),
                    'name' => 'Administrator',
                ],

                // System Operator
                [
                    'username' => 'system',
                    'email' => 'system@example.com',
                    'password' => Hash::make('system'),
                    'name' => 'System Operator',
                ],

                // Content Operator
                [
                    'username' => 'content',
                    'email' => 'content@example.com',
                    'password' => Hash::make('content'),
                    'name' => 'Content Operator',
                ],

                // Damoa Capital
                [
                    'username' => 'damoa',
                    'email' => 'damoa@example.com',
                    'password' => Hash::make('123456789'),
                    'name' => 'Damoa Capital',
                ]
            ];

            foreach ($users as $user) {
                $this->createUser($user);
            }
        }
    }

    private function createUser($data) {
        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->name = $data['name'];
        $user->language = 'en';
        $user->avatar = null;
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
    }
}
