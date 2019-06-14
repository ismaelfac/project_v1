<?php

namespace App\Modelsgenerals;

use App\MethodsBase;
use App\Modelsgenerals \{
    Country, Municipality
};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Departament extends Model
{
    use MethodsBase;

    protected $fillable = ['description', 'short_name', 'country_id'];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
    public static function factoryDepartament()
    {
        $result = Departament::whereNotIn('id', [0, -1])->where('country_id', 45)->pluck('id')->all();
        $response = self::randomFactory($result);
        return $response;
    }

}