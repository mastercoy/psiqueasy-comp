<?php

namespace Tests\Feature;


use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PacienteTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function paciente_pode_ser_adicionado() {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/paciente-json', [
            'name' => 'obrigatorio'
        ]);

        $this->assertCount(1, Paciente::all());

    }

    /** @test */ //
    public function paciente_tem_campos_obrigatorios() {

        $response = $this->post('/api/paciente-json', [
            'name' => ''
        ]);

        $response->assertSessionHasErrors('name');


    }

    /** @test */ //
    public function paciente_pode_ser_atualizada() {

        $response = $this->post('/api/paciente-json', [
            'name' => 'obrigatorio'
        ]);

        $paciente = Paciente::first();

        $response = $this->patch('/api/paciente-json/' . $paciente->id, [
            'name' => 'novo nome'
        ]);

        $this->assertEquals('novo nome', Paciente::first()->name);


    }

    /** @test */ //
    public function paciente_pode_ser_destruida() {

        $response = $this->post('/api/paciente-json', [
            'name' => 'obrigatorio'
        ]);

        $this->assertCount(1, Paciente::all());

        $paciente = Paciente::first();
        $response = $this->delete('/api/paciente-json/' . $paciente->id);
        $this->assertCount(0, Paciente::all());
    }

    /** @test */ //
    public function paciente_soft_delete() {

        $response = $this->post('/api/paciente-json', [
            'name' => 'obrigatorio'
        ]);

        $paciente = Paciente::first();
        $response = $this->patch('/api/desativar-paciente-json/' . $paciente->id);
        $this->assertEquals(0, Paciente::first()->active);

    }

}


















