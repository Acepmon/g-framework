<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SystemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AuthPagesTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(UserPermissionTableSeeder::class);
        $this->call(UserGroupTableSeeder::class);
        $this->call(TermTaxonomyTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
    }
}
