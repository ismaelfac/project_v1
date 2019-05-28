<?php

use Illuminate\Database\Seeder;
use App\Customer;
use App\Http\Controllers\PropertiesWasiController;
use Illuminate\Support\Str as Str;
use App\Modelsgenerals \{
    Country, Departament, Municipality
};

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        $data = PropertiesWasiController::getDataWasi('client/search');
        $lengthCustomers = sizeof($data);
        dd('customers');
        for ($i = 0; $i <= $lengthCustomers; $i++) {
            error_reporting(0);
            Customer::firstOrCreate([
                'customer_wasi_id' => $data['id_client'],
                'user_wasi_id' => $data['id_user'],
                'first_name' => ucwords($data['first_name']),
                'last_name' => ucwords($data['last_name']),
                'slug' => str::slug($data['last_name'] . ' ' . $data['fisrt_name']),
                'dni' => $data['id_client'],
                'phone' => $data['cell_phone'],
                'landline' => $data['phone'],
                'email' => $data['email'],
                'address' => $data['address'],
                'country_id' => Departament::getCountryWasiAttribute($data['country_label']),
                'departament_id' => $data['departament_id'],
                'municipality_id' => $data['municipality_id'],
                'location_id' => $data['location_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'birthdate' => $data['birthdate'],
                'active' => $data['active']
            ]);
        }

    }
}
