<?php

namespace Tests\Feature;

use App\Responsavel;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsavelTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();


    /** @test */ //SUCESSO
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

    /** @test */ //SUCESSO
    public function nome_responsavel_deve_ser_obrigatorio() {

        $response = $this->post('/api/responsavel-json', [
            'name' => '',
            'parentesco' => 'irmão',
        ]);

        $response->assertSessionHasErrors('name');


    }

    /** @test */ //SUCESSO
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

    /** @test */
    public function responsável_pode_ser_destruido() {


        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste'
        ]);

        $this->assertCount(1, Responsavel::all());
        $responsavel = Responsavel::first();


    }

    /** @test */ //SUCESSO
    public function responsavel_soft_delete() {

        $response = $this->post('/api/responsavel-json', [
            'name' => 'obrigatorio',
            'parentesco' => 'irmão',
            'end' => 'endereço teste',
        ]);


        $responsavel = Responsavel::first();
        $response    = $this->patch('/api/desativar-responsavel-json/' . $responsavel->id);

        $this->assertEquals(0, Responsavel::first()->active);


    }

    /** @test */ //SUCESSO
    public function retorna_responsaveis_soft_delete() {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/user-json', [
            'name' => 'user 1',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $response = $this->post('/api/responsavel-json', [
            'name' => 'responsavel 1 falso',
            'parentesco' => 'irmão',
            'end' => 'endereço teste',
            'active' => false,
            'user_id' => '1'
        ]);

        $response = $this->post('/api/responsavel-json', [
            'name' => 'responsavel 2 falso',
            'parentesco' => 'irmão',
            'end' => 'endereço teste',
            'active' => false,
            'user_id' => '1'
        ]);

        $response = $this->post('/api/responsavel-json', [
            'name' => 'responsavel 3 falso',
            'parentesco' => 'mae',
            'end' => 'endereço teste',
            'active' => false,
            'user_id' => '1'
        ]);

        $response = $this->post('/api/responsavel-json', [
            'name' => 'responsavel 4 true',
            'parentesco' => 'pai',
            'end' => 'endereço teste',
            'active' => true,
            'user_id' => '1'
        ]);

        $this->assertCount(4, Responsavel::all());
        $this->assertCount(1, User::all());

        $user = User::first();


        $test = $this->getJson($this->get('/api/excluidos-responsavel-json', $user))->content();
        dd($test);
        //afazer


    }
}
