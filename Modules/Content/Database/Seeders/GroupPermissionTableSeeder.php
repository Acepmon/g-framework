<?php

namespace Modules\Content\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Group;
use App\Permission;
use App\Entities\PermissionManager;

class GroupPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Attach All Permissions to Admin Group
        PermissionManager::attachGroupPermissions(1, Permission::all());

        // Attach Basic & Admin Permissions to Operator Group
        PermissionManager::attachGroupPermissions(2, Permission::where('title', '')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'home')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'page')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'login')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'register')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'logout')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'password_reset')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'password_update')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'password_request')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'verification_verify')->get());

        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'admin_dashboard')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'admin_changelog')->get());
        PermissionManager::attachGroupPermissions(2, Permission::where('title', 'LIKE', 'admin_profile%')->get());

        // Attach Basic Permissions to Member Group
        PermissionManager::attachGroupPermissions(3, Permission::where('title', '')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'home')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'page')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'login')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'register')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'logout')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'password_reset')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'password_update')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'password_request')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'verification_verify')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_users_read')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_users_update')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_contents_read')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_contents_create')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_contents_update')->get());
        PermissionManager::attachGroupPermissions(3, Permission::where('title', 'ajax_groups_update')->get());

        // Attach System Permissions to System Operator Group
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_configs%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_logs%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_notifications%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_backups%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_themes%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_users%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_groups%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'admin_permissions%')->get());
        PermissionManager::attachGroupPermissions(6, Permission::where('title', 'LIKE', 'ajax_users%')->get());

        // Attach Content Permissions to Content Operator Group
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_menus%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_contents%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_comments%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_taxonomy%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_localizations%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_media%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'admin_banners%')->get());
        PermissionManager::attachGroupPermissions(7, Permission::where('title', 'LIKE', 'ajax_contents%')->get());

        $nonSystem = Group::where('title', 'Damoa Operator')->first()->id;
        PermissionManager::attachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'admin_changelog')->get());
        // PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_content%')->get());
        // PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_permission%')->get());
        // PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_groups%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_configs%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_themes%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_backups%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_logs%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_localizations%')->get());
        PermissionManager::detachGroupPermissions($nonSystem, Permission::where('title', 'LIKE', 'admin_taxonomy%')->get());
    }
}
