<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'users' )->truncate();
        DB::table( 'roles' )->truncate();
        DB::table( 'permissions' )->truncate();
        DB::table( 'password_resets' )->truncate();
        DB::table( 'role_has_permissions' )->truncate();
        DB::table( 'user_has_permissions' )->truncate();
        DB::table( 'user_has_roles' )->truncate();

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);

        $adminRole = \Spatie\Permission\Models\Role::create([
            'name' => 'admin'
        ]);

        $adminUser->assignRole( $adminRole->name );
    }
}
