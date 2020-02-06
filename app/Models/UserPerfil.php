<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userperfil';

    public function user_pivot() {
        return $this->belongsToMany('App\Models\UserPerfilPivot');
    }

    public function permissoes_pivot() {
        return $this->belongsToMany('App\Models\PerfilPermissaoPivot');
    }

}
