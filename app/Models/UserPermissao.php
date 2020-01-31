<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermissao extends Model {
    //
    protected $guarded = [];
    protected $table   = 'userpermissao';

    public function perfis() {
        return $this->belongsToMany('App\Models\UserPerfil')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
