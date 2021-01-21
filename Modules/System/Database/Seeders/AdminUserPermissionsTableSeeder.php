<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\PermissionManager;

class AdminUserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionManager::newPermissionCrud('admin_users');
        PermissionManager::newPermissionCrud('admin_users_metas');
        PermissionManager::newPermissionCrud('admin_users_permissions');
        PermissionManager::newPermissionCrud('admin_users_groups');
        PermissionManager::newPermissionCrud('admin_users_contents');
        PermissionManager::newReadPermission('admin_users_administrators');
        PermissionManager::newReadPermission('admin_users_operators');
        PermissionManager::newReadPermission('admin_users_guests');

        PermissionManager::newPermissionCrud('admin_permissions');
        PermissionManager::newPermissionCrud('admin_company');
        PermissionManager::newPermissionCrud('admin_groups');
        PermissionManager::newCreatePermission('admin_groups_createMenu');
        PermissionManager::newReadPermission('admin_groups_readMenuGroup');
        PermissionManager::newUpdatePermission('admin_groups_removeMenu');
        PermissionManager::newCreatePermission('admin_groups_createUser');
        PermissionManager::newReadPermission('admin_groups_readUserGroup');
        PermissionManager::newUpdatePermission('admin_groups_removeUser');
        PermissionManager::newCreatePermission('admin_groups_createPermission');
        PermissionManager::newReadPermission('admin_groups_readPermissionGroup');
        PermissionManager::newUpdatePermission('admin_groups_removePermission');
    }
}
