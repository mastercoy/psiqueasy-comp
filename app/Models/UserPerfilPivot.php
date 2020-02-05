<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfilPivot extends Model {
    //

    protected $table = 'users_userperfil';

    public function users() {
        return $this->hasMany('App\User')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

    public function perfis() {
        return $this->hasMany('App\Models\UserPerfil')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
