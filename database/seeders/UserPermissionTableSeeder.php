<?php
namespace Database\seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $role = Role::find(1);
        if (!blank($user) && !blank($role)) {
            $user->assignRole($role->name);
        }
        $user->givePermissionTo(Permission::all());
    }
}
