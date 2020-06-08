<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();
        $role_emple = Role::where('name', 'emple')->first();              

        $user = new User();
        $user->name = 'Dayana Perez';
        $user->identification = '123456789';
        $user->email = 'dayanna@gmail.com';
        $user->password = bcrypt('secret');
        $user->estado = 'Activo';
        $user->save();
        $user->roles()->attach($role_emple);

        $user = new User();
        $user->name = 'Prueba';
        $user->identification = '09876543';
        $user->email = 'prueba@gmail.com';
        $user->password = bcrypt('secret');
        $user->estado = 'Activo';
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Juan David';
        $user->identification = '1144107423';
        $user->email = 'juandavidxd02@gmail.com';
        $user->password = bcrypt('123456');
        $user->estado = 'Activo';
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
