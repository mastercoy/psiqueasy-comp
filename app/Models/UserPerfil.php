<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userperfil';

    public function permissoes() {
        return $this->hasMany('App\Models\UserPermissao')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

    public function usuarios() {
        return $this->belongsToMany('App\Models\User')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

}
