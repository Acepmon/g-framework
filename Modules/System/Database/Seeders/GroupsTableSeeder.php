<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use DB;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('groups')) {
            // System Groups
            DB::table('groups')->insert([
                [
                    "title" => "Administrator",
                    "description" => "Administrator is the most powerful user role and should rarely be assigned to any other account.",
                    "type" => Group::TYPE_SYSTEM
                ],
                [
                    "title" => "Operator",
                    "description" => "Operators are the sub-system management user. Who has carefully selected privileges and permissions to specific services.",
                    "type" => Group::TYPE_SYSTEM
                ],
                [
                    "title" => "Member",
                    "description" => "Essentially the most basic role of all. No special privileges are granted, only the basic requirements are added such as authentication, viewing public posts etc..",
                    "type" => Group::TYPE_SYSTEM
                ],
                [
                    "title" => "Guest",
                    "description" => "Non member entity who has brief access to some services for a temporary time. Any user who is not registered is considered 'guest' by default.",
                    "type" => Group::TYPE_SYSTEM
                ],
                [
                    "title" => "Damoa",
                    "description" => "ДАМОА МОТОРС ХХК нь 2012 онд үүсгэн байгуулагдсан цагаасаа өнөөг хүртэл Монголын санхүүгийн зах зээлд үйлчлүүлэгчдийн талархлыг хүлээн ажилласаар байна..",
                    "type" => Group::TYPE_DEALER,
                ]
            ]);

            // Dynamic Groups
            DB::table('groups')->insert([
                [
                    "title" => "System Operator",
                    "description" => "System Management and User, Groups, Permissions Management",
                    "type" => Group::TYPE_DYNAMIC,
                    "parent_id" => 2
                ],
                [
                    "title" => "Content Operator",
                    "description" => "Pages, Post Manager and Menus, Localizations, Media Management",
                    "type" => Group::TYPE_DYNAMIC,
                    "parent_id" => 2
                ],
            ]);

            // $id = Group::find('id')->where('title', 'Damoa');

            DB::table('group_metas')->insert([
                [
                    "group_id" => 5,
                    "key" => "address",
                    "value" => "УБ, Баянгол, Үндсэн хуулийн гудамж 24, 'Рокмон бюлдинг' 301 тоот"
                ],
                [
                    "group_id" => 5,
                    "key" => "schedule",
                    "value" => "Даваа~Баасан  : 09:00 ~ 19:00      Бямба гариг : 10:00 ~17:00"
                ],
                [
                    "group_id" => 5,
                    "key" => "retailImage",
                    "value" => "\assets\images\login-covers\\493628.jpg"
                ],
                [
                    "group_id" => 5,
                    "key" => "website",
                    "value" => "https://www.damoacapital.com/"
                ],
                [
                    "group_id" => 5,
                    "key" => "retailPhone",
                    "value" => "7011-1211, 9585-1140"
                ],
            ]);
        }
    }
}
