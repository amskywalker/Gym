<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->role_and_permissions();
    }

    public function role_and_permissions()
    {
        $arrayOfRoleNames = ['funcionario'];
        $permissions = collect($arrayOfRoleNames)->map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web', 'created_at' => now()];
        });

        Role::insert($permissions->toArray());

        $permissionsByRole = [
            'funcionario' =>
                [
                    'index_brand',
                    'edit_brand',
                    'create_brand',
                    'delete_brand',
                    'update_brand',
                    'index_material',
                    'edit_material',
                    'create_material',
                    'delete_material',
                    'update_material'
                ]
        ];

        $insertPermissions = fn($role) => collect($permissionsByRole[$role])
            ->map(fn($name) => DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => 'web', 'created_at' => now()]))
            ->toArray();

        $permissionIdsByRole = [
            'funcionario' => $insertPermissions('funcionario'),
        ];
        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }
    }
}
