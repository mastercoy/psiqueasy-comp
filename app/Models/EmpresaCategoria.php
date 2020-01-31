<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaCategoria extends Model {
    //
    protected $table   = 'empresa_categorias';
    protected $guarded = [];

    public function empresa() {
        return $this->belongsToMany('App\Models\Empresa')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
