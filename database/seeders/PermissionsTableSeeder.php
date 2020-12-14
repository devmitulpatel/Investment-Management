<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'kisan_vikar_patra_for_user_create',
            ],
            [
                'id'    => 18,
                'title' => 'kisan_vikar_patra_for_user_edit',
            ],
            [
                'id'    => 19,
                'title' => 'kisan_vikar_patra_for_user_show',
            ],
            [
                'id'    => 20,
                'title' => 'kisan_vikar_patra_for_user_delete',
            ],
            [
                'id'    => 21,
                'title' => 'kisan_vikar_patra_for_user_access',
            ],
            [
                'id'    => 22,
                'title' => 'investments_for_user_access',
            ],
            [
                'id'    => 23,
                'title' => 'policy_for_user_create',
            ],
            [
                'id'    => 24,
                'title' => 'policy_for_user_edit',
            ],
            [
                'id'    => 25,
                'title' => 'policy_for_user_show',
            ],
            [
                'id'    => 26,
                'title' => 'policy_for_user_delete',
            ],
            [
                'id'    => 27,
                'title' => 'policy_for_user_access',
            ],
            [
                'id'    => 28,
                'title' => 'fd_for_user_create',
            ],
            [
                'id'    => 29,
                'title' => 'fd_for_user_edit',
            ],
            [
                'id'    => 30,
                'title' => 'fd_for_user_show',
            ],
            [
                'id'    => 31,
                'title' => 'fd_for_user_delete',
            ],
            [
                'id'    => 32,
                'title' => 'fd_for_user_access',
            ],
            [
                'id'    => 33,
                'title' => 'bank_account_create',
            ],
            [
                'id'    => 34,
                'title' => 'bank_account_edit',
            ],
            [
                'id'    => 35,
                'title' => 'bank_account_show',
            ],
            [
                'id'    => 36,
                'title' => 'bank_account_delete',
            ],
            [
                'id'    => 37,
                'title' => 'bank_account_access',
            ],
            [
                'id'    => 38,
                'title' => 'settings_for_admin_access',
            ],
            [
                'id'    => 39,
                'title' => 'bank_for_admin_create',
            ],
            [
                'id'    => 40,
                'title' => 'bank_for_admin_edit',
            ],
            [
                'id'    => 41,
                'title' => 'bank_for_admin_show',
            ],
            [
                'id'    => 42,
                'title' => 'bank_for_admin_delete',
            ],
            [
                'id'    => 43,
                'title' => 'bank_for_admin_access',
            ],
            [
                'id'    => 44,
                'title' => 'branch_of_banks_for_admin_create',
            ],
            [
                'id'    => 45,
                'title' => 'branch_of_banks_for_admin_edit',
            ],
            [
                'id'    => 46,
                'title' => 'branch_of_banks_for_admin_show',
            ],
            [
                'id'    => 47,
                'title' => 'branch_of_banks_for_admin_delete',
            ],
            [
                'id'    => 48,
                'title' => 'branch_of_banks_for_admin_access',
            ],
            [
                'id'    => 49,
                'title' => 'holders_for_admin_create',
            ],
            [
                'id'    => 50,
                'title' => 'holders_for_admin_edit',
            ],
            [
                'id'    => 51,
                'title' => 'holders_for_admin_show',
            ],
            [
                'id'    => 52,
                'title' => 'holders_for_admin_delete',
            ],
            [
                'id'    => 53,
                'title' => 'holders_for_admin_access',
            ],
            [
                'id'    => 54,
                'title' => 'nsc_for_user_create',
            ],
            [
                'id'    => 55,
                'title' => 'nsc_for_user_edit',
            ],
            [
                'id'    => 56,
                'title' => 'nsc_for_user_show',
            ],
            [
                'id'    => 57,
                'title' => 'nsc_for_user_delete',
            ],
            [
                'id'    => 58,
                'title' => 'nsc_for_user_access',
            ],
            [
                'id'    => 59,
                'title' => 'nominees_for_admin_create',
            ],
            [
                'id'    => 60,
                'title' => 'nominees_for_admin_edit',
            ],
            [
                'id'    => 61,
                'title' => 'nominees_for_admin_show',
            ],
            [
                'id'    => 62,
                'title' => 'nominees_for_admin_delete',
            ],
            [
                'id'    => 63,
                'title' => 'nominees_for_admin_access',
            ],
            [
                'id'    => 64,
                'title' => 'insurance_for_user_create',
            ],
            [
                'id'    => 65,
                'title' => 'insurance_for_user_edit',
            ],
            [
                'id'    => 66,
                'title' => 'insurance_for_user_show',
            ],
            [
                'id'    => 67,
                'title' => 'insurance_for_user_delete',
            ],
            [
                'id'    => 68,
                'title' => 'insurance_for_user_access',
            ],
            [
                'id'    => 69,
                'title' => 'fd_recurring_for_user_create',
            ],
            [
                'id'    => 70,
                'title' => 'fd_recurring_for_user_edit',
            ],
            [
                'id'    => 71,
                'title' => 'fd_recurring_for_user_show',
            ],
            [
                'id'    => 72,
                'title' => 'fd_recurring_for_user_delete',
            ],
            [
                'id'    => 73,
                'title' => 'fd_recurring_for_user_access',
            ],
            [
                'id'    => 74,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
