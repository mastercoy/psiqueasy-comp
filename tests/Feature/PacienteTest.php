<?php

//namespace Tests\Feature;


use App\Models\Paciente;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PacienteTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function paciente_pode_ser_adicionado() {

        $paciente = factory(App\Models\Paciente::class, 1)->create();
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

        $paciente = factory(App\Models\Paciente::class, 1)->create();
        $paciente = Paciente::first();
        $user     = factory(App\User::class, 1)->create();
        $user     = User::first();

        $response = $this->actingAs($user)->patch('/api/paciente-json/' . $paciente->id, [
            'name' => 'novo nome'
        ]);

        $this->assertEquals('novo nome', Paciente::first()->name);


    }

    /** @test */ //
    public function paciente_pode_ser_destruida() {

        $paciente = factory(App\Models\Paciente::class, 1)->create();
        $paciente = Paciente::first();
        $this->assertCount(1, Paciente::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/paciente-json/' . $paciente->id);
        $this->assertCount(0, Paciente::all());
    }

    /** @test */ //
    public function paciente_soft_delete() {

        $paciente = factory(App\Models\Paciente::class, 1)->create();
        $paciente = Paciente::first();
        $user     = factory(App\User::class, 1)->create();
        $user     = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-paciente-json/' . $paciente->id);
        $this->assertEquals(0, Paciente::first()->active);

    }

}


















