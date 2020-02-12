<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userperfil';


    public function user() {
        return $this->belongsToMany('App\User', 'perfil_user',
                                    'perfil_id', 'user_id');
    }

    public function permissao() {
        return $this->belongsToMany('App\Models\UserPermissao', 'perfil_permissao',
                                    'perfil_id', 'permissao_id');

    }


}
