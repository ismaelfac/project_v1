<?php

namespace App\Modelsgenerals;

use App\MethodsBase;
use App\ModelsApp\Customer;
use App\Modelsgenerals\Identification;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    use MethodsBase;

    protected $fillable = ['description', 'shortName'];
    protected $guarded = 'id';
    public $timestamps = false;

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
    public static function factoryDni()
    {
        $num = Identification::whereNotIn('id', [0, 4, 5])->pluck('id')->all();
        return self::randomFactory($num);

    }
}
