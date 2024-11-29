<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Permission::cases() as $permission) {
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission,
            ]);
        }

        foreach (RoleEnum::cases() as $role) {
            $role = \Spatie\Permission\Models\Role::create([
                'name' => $role->value,
            ]);

            $this->syncPermissionsToRole($role);
        }
    }

    private function syncPermissionsToRole(Role $role): void
    {
        $permissions = [];

        switch ($role->name) {
            case RoleEnum::Admin->value:
                $permissions = array_map(fn($perm) => $perm->value, Permission::cases());;
                break;
            case RoleEnum::Faculty->value:
                $permissions = [
                    Permission::VIEW_STUDENT->value,
                    Permission::VIEW_ALL_STUDENTS->value,
                    Permission::VIEW_FACULTY->value,
                    Permission::VIEW_ACADEMIC_RECORD->value,
                    Permission::VIEW_ALL_ACADEMIC_RECORDS->value,
                    Permission::CREATE_ACADEMIC_RECORD->value,
                    Permission::UPDATE_ACADEMIC_RECORD->value
                ];
                break;
            case RoleEnum::Student->value:
                $permissions = [
                    Permission::VIEW_STUDENT->value,
                    Permission::VIEW_ACADEMIC_RECORD->value,
                ];
                break;
        }

        $role->syncPermissions($permissions);
    }
}
