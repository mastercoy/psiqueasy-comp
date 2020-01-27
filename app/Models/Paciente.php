<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {
    //
    public function atendimentos() {
        return $this->hasMany('App\Models\Atendimentos')
                    ->where('active', 1)
                    ->orderBy('data', 'asc');
    }
}
