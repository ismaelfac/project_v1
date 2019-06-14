<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    
    public function run()
    {
        $data = file_get_contents("database/Queries/permissions.json");
        $permissions = json_decode($data, true);
        //dd($permissions);
        foreach ($permissions as $value) {
            Permission::create([
                'name' => $value['name'],
                'slug' => $value['slug'],
                'description' => $value['description'],
                'variant' => $value['variant'],
                'is_system' => $value['is_system']
            ]);
        }
    }
}
