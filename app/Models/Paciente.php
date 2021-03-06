<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {
    //
    protected $guarded = [];
    protected $table   = 'pacientes';

    public function atendimentos() {
        return $this->hasMany('App\Models\Atendimento')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
