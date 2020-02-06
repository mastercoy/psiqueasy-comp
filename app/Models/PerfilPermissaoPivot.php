<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilPermissaoPivot extends Model {
    //

    protected $table   = 'userperfil_userpermissao';
    protected $guarded = [];

    public function perfis() {
        return $this->hasMany('App\Models\UserPerfil');
    }

    public function permissoes() {
        return $this->hasMany('App\Models\UserPermissoes');
    }

}
