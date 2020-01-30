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

    /** @test */
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

    //afazer a partir daqui
}


















