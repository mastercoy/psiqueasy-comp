<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model {

    protected $guarded = [];

    public function paciente() {
        return $this->belongsTo('App\Models\Paciente', 'paciente_id');
    }
}
