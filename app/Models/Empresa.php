<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {
    //
    protected $guarded = [];

    public function categorias() {
        return $this->hasMany('App\Models\EmpresaCategoria')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

    public function filiais() {
        return $this->hasMany('App\Models\EmpresaFilial')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }

    public function modelos() {
        return $this->hasMany('App\Models\EmpresaModeloDocs')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
