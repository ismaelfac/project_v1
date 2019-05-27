<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'state' => 'boolean'
    ];

    public function Roles()
    {
        $roles = auth()->user()->roles;
    }


    public function isInactive()
    {
        return $this->state === false;
    }

    public function isAdmin() 
    {
        return $this->role === 'admin';
    }

    public function owns(Model $model, $foreignKey = 'user_id')
    {
        //dd($this->id.'-'.$model->user_id);
        return $this->id === $model->$foreignKey;
    }
}
