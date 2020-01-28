<?php

namespace Tests\Feature;

use App\Responsavel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsavelTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();


    /** @test */ //obs SUCESSO
    public function um_user_pode_ser_adicionado() {

        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste'
        ]);

        $responsavel = Responsavel::first();
//        dd($responsavel);
        $this->assertCount(1, Responsavel::all());
    }

    /** @test */ //obs SUCESSO
    public function nome_responsavel_deve_ser_obrigatorio() {

        $response = $this->post('/api/responsavel-json', [
            'name' => '',
            'parentesco' => 'irmão',
        ]);

        $response->assertSessionHasErrors('name');


    }

    /** @test */ //obs SUCESSO
    public function responsavel_pode_ser_atualizado() {

        $this->withoutExceptionHandling();
        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste'
        ]);

        $responsavel = Responsavel::first();
        $response    = $this->patch('/api/responsavel-json/' . $responsavel->id, [
            'name' => 'novo nome',
            'parentesco' => 'pai',
            'end' => 'novo endereço'
        ]);

//        dd(Responsavel::first());
        $this->assertEquals('novo nome', Responsavel::first()->name);

    }
}
