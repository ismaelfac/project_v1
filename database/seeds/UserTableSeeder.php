<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'administrador',
            'description' => 'Acceso total al sistema',
            'special' => 'all-access'
        ]);
        Role::create([
            'name' => 'Suspendidos',
            'slug' => 'suspendido',
            'description' => 'Sin acceso al sistema',
            'special' => 'no-access'
        ]);
        $role = Role::create([
            'name' => 'Auditor',
            'slug' => 'auditor',
            'description' => 'Puede ver o Generar reportes de los modulos',
            'special' => null
        ]);
        $role->permissions()->sync([1, 2, 3, 4, 5, 10, 15, 24,25,26,27,29,30]);
        $role = Role::create([
            'name' => 'Asesores',
            'slug' => 'consultants',
            'description' => 'Asignado a los asesores: <br> Permite: Crear, actualizar desactivar.',
            'special' => null
        ]);
        $role->permissions()->sync([1, 2, 3, 4, 5]);
        $user = User::create([
            'name' => 'ISMAEL E. LASTRE ALVAREZ',
            'email' => 'ismaelfac@gmail.com',
            'password' => bcrypt('BrwQ12-123'),
            'active' => true
        ]);
        $user->roles()->sync([1 => ['active' => true]]); //update roles
        $user = User::create([
            'name' => 'SINFOROSO GUMERSINDO',
            'email' => 'director@mail.com',
            'password' => bcrypt('123'),
            'active' => true
        ]);
        $user->roles()->sync([1 => ['active' => true]]); //update roles
        $user = User::create([
            'name' => 'EMPERATRIS BENAVIDEZ ',
            'email' => 'asistentecomercial@MAIL.com',
            'password' => bcrypt('123'),
            'active' => true
        ]);
        $user->roles()->sync([3 => ['active' => true],4]); //update roles 3, 4 en usuario3
    
    }
}
