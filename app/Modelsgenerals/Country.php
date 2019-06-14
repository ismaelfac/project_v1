<?php

namespace App\Modelsgenerals;

use Illuminate\Database\Eloquent\Model;
use App\Modelsgenerals \{
    Departament
};
use App\ModelsApp\Customer;

class Country extends Model
{
    //
    protected $fillable = ['code', 'description', 'nationality', 'short_name'];

    public $timestamps = false;
    
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function departaments()
    {
        return $this->hasMany(Departament::class);
    }
}