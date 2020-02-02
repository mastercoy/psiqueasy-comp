<?php

namespace Tests\Feature;


use App\Models\UserPerfil;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPerfilTest extends TestCase {


    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_criado() {

        $response = $this->post('/api/user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPerfil::all());

    }

    /** @test */ //SUCESSO
    public function user_perfil_tem_campos_obrigatorios() {

        $response = $this->post('/api/user-perfil-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_atualizado() {

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $response = $this->post('/api/user-perfil-json', [
            'name' => 'nome obrigatorio',
            'user_id' => '1'
        ]);

        $perfil   = UserPerfil::first();
        $user     = User::first();
        $response = $this->actingAs($user)->patch('/api/user-perfil-json/' . $perfil->id, [
            'name' => 'novo nome',

        ]);

        $this->assertEquals('novo nome', UserPerfil::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_destruido() {

        $response = $this->post('/api/user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPerfil::all());

        $perfil   = UserPerfil::first();
        $response = $this->delete('/api/user-perfil-json/' . $perfil->id);

        $this->assertCount(0, UserPerfil::all());
    }

    /** @test */ //SUCESSO
    public function user_perfil_soft_delete() {

        $response = $this->post('/api/user-perfil-json', [
            'name' => 'nome obrigatorio',
        ]);

        $perfil   = UserPerfil::first();
        $response = $this->patch('/api/desativar-user-perfil-json/' . $perfil->id);
        $this->assertEquals(0, UserPerfil::first()->active);
    }

    /** @test */ //SUCESSO
    public function update_obedece_gate() {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $this->assertCount(1, User::all());


        $response = $this->post('/api/user-perfil-json', [
            'name' => 'nome obrigatorio',
            'user_id' => 1
        ]);

        $user   = User::first();
        $perfil = UserPerfil::first();


        $response = $this->actingAs($user)->patch('/api/user-perfil-json/' . $perfil->id, [
            'name' => 'novo nome',

        ]);

        $this->assertEquals('novo nome', UserPerfil::first()->name);

    }


}

















