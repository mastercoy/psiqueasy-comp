<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermissao extends Model {
    //
    protected $guarded = [];
    protected $table   = 'permissao';

    /*public function getNameAttribute($value) {
        return $value;
    }*/

    public function perfil() {
        return $this->belongsToMany('App\Models\UserPerfil', 'perfil_permissao',
                                    'permissao_id', 'perfil_id');
    }


}
