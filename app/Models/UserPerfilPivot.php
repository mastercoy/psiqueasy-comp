<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfilPivot extends Model {
    //
    protected $guarded = [];
    protected $table   = 'users_userperfil';

    public function users() {
        return $this->hasMany('App\User');
    }

    public function perfis() {
        return $this->hasMany('App\Models\UserPerfil');
    }
}
