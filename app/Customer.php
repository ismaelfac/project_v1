<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Modelsgenerals \{
    Country, Departament, Identification, Location, Municipality, Neighborhood, CustomerRol, ClientType
};
use Carbon\Carbon as Carbon;

class Customer extends Model
{

    protected $table = 'customers';
    protected $fillable = ['customer_wasi_id', 'first_name', 'last_name', 'slug', 'dni', 'type_dni', 'phone', 'landline', 'email', 'address', 'country_id', 'departament_id', 'municipality_id', 'location_id', 'neighborhood_id', 'latitude', 'longitude', 'birthdate', 'state_customer'];
    protected $casts = [

    ];
 
    public function country()
    {
        return $this->hasOne(Country::class);
    }
    public function departament()
    {
        return $this->hasOne(Departament::class);
    }
    public function location()
    {
        return $this->hasOne(Location::class);
    }
    public function neighborhood()
    {
        return $this->hasOne(Neighborhood::class);
    }
    public function identification()
    {
        return $this->hasOne(Identification::class, 'type_dni');
    }
    public function getCreatedAtAttribute($date) { return Carbon::createFromFormat('Ymd H:i:s', $date)->format('Ym-d'); } 
    public function getUpdatedAtAttribute($date) { return Carbon::createFromFormat('Ymd H:i:s', $date)->format('Ym-d'); } 

    public static function getcustomersAttribute()
    {
        $customers = Customer::query()->with('identification', 'country', 'departament', 'location', 'neighborhood')->paginate(5);
        return $customers;
    }





}
