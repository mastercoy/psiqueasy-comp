<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermissao extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userpermissao';

    public function getNameAttribute($value) {
        return $value;
    }

    public function perfis_pivot() {
        return $this->belongsToMany('App\Models\PerfilPermissao');
    }
}
