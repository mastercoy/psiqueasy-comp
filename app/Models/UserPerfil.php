<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userperfil';

    public function user_pivot() {
        return $this->belongsToMany('App\Models\UserPerfilPivot')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

    public function permissoes_pivot() {
        return $this->belongsToMany('App\Models\PerfilPermissaoPivot')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

}
