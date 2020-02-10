<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userperfil';


    public function user() {
        return $this->belongsToMany('App\User', 'users_userperfil',
                                    'userperfil_id', 'user_id');
    }

    public function permissao() {
        return $this->belongsToMany('App\Models\UserPermissao', 'userperfil_userpermissao',
                                    'userperfil_id', 'userpermissao_id');

    }

    /*public function user_pivot() {
        return $this->belongsToMany('App\Models\UserPerfilPivot');
    }

    public function permissoes_pivot() {
        return $this->belongsToMany('App\Models\PerfilPermissaoPivot');
    }*/

}
