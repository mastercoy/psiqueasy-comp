<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $guarded = [];
    protected $hidden  = [
        'password', 'remember_token',
    ];

    public function modelos() {
        return $this->hasMany('App\Models\UserModeloDocs');

    }


    public function perfilpivot() {
        return $this->hasOne('App\Models\UserPerfilPivot');

    }
}
