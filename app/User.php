<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token',];

    public function perfil() {
        return $this->belongsToMany('App\Models\UserPerfil', 'perfil_user',
                                    'user_id', 'perfil_id');
    }


}
