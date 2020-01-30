<?php

namespace Tests\Feature;


use App\Models\UserPerfil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPerfilTest extends TestCase {


    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_criado() {

        $response = $this->post('/api/criar-user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPerfil::all());

    }

    /** @test */ //SUCESSO
    public function user_perfil_tem_campos_obrigatorios() {

        $response = $this->post('/api/criar-user-perfil-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_atualizado() {

        $response = $this->post('/api/criar-user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $perfil = UserPerfil::first();

        $response = $this->patch('/api/editar-user-perfil-json/' . $perfil->id, [
            'name' => 'novo nome',

        ]);

        $this->assertEquals('novo nome', UserPerfil::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_destruido() {

        $response = $this->post('/api/criar-user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPerfil::all());

        $perfil   = UserPerfil::first();
        $response = $this->delete('/api/destruir-user-perfil-json/' . $perfil->id);

        $this->assertCount(0, UserPerfil::all());
    }

    /** @test */
    public function user_perfil_soft_delete() {

        $response = $this->post('/api/criar-user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $perfil   = UserPerfil::first();
        $response = $this->patch('/api/desativar-user-perfil-json/' . $perfil->id);
        $this->assertEquals(0, UserPerfil::first()->active);
    }


}


















