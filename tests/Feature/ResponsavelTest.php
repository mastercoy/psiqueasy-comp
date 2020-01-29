<?php

namespace Tests\Feature;

use App\Responsavel;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsavelTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();


    /** @test */ //obs SUCESSO
    public function um_responsavel_pode_ser_adicionado() {

        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste',
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

    /** @test */ //obs SUCESSO fixme sem gate
    public function responsavel_pode_ser_atualizado() {

//        $this->withoutExceptionHandling();
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

    /** @test */ //afazer
    public function retorna_responsaveis_soft_delete() {

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $user = User::first();
        //        dd($user);
        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste',
            'active' => false,
            'user_id' => $user->id

        ]);

        $responsavel = Responsavel::first();
        //        dd(Responsavel::first());


    }

    /** @test */ //obs SUCESSO fixme sem gate
    public function responsável_pode_ser_destruido() {

        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste'
        ]);

        $this->assertCount(1, Responsavel::all());
        $responsavel = Responsavel::first();
        $response    = $this->delete('/api/responsavel-json/' . $responsavel->id);
        $this->assertCount(0, Responsavel::all());

    }
}
