<?php

namespace Tests\Feature;


use App\Models\Userpermissao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPermissãoTest extends TestCase {


    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_criada() {

        $response = $this->post('/api/criar-user-permissao-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPermissao::all());

    }

    /** @test */ //SUCESSO
    public function user_permissao_tem_campos_obrigatorios() {

        $response = $this->post('/api/criar-user-permissao-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_atualizada() {

        $response = $this->post('/api/criar-user-permissao-json', [
            'name' => 'nome obrigatorio',
            'active' => '1',

        ]);
        $this->assertCount(1, UserPermissao::all());
        $permissao = UserPermissao::first();

        $response = $this->patch('/api/editar-user-permissao-json/' . $permissao->id, [
            'name' => 'novo nome',
            'active' => '1',

        ]);

//        dd(UserPermissao::first());

        $this->assertEquals('novo nome', Userpermissao::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_destruida() {

        $response = $this->post('/api/criar-user-permissao-json', [
            'name' => 'nome obrigatorio',
        ]);

        $this->assertCount(1, UserPermissao::all());

        $permissao = UserPermissao::first();
        $response  = $this->delete('/api/destruir-user-permissao-json/' . $permissao->id);

        $this->assertCount(0, UserPermissao::all());
    }

    /** @test */ //SUCESSO
    public function user_permissao_soft_delete() {

        $response = $this->post('/api/criar-user-permissao-json', [
            'name' => 'nome obrigatorio',
        ]);

        $permissao = UserPermissao::first();
        $response  = $this->patch('/api/desativar-user-permissao-json/' . $permissao->id);
        $this->assertEquals(0, UserPermissao::first()->active);
    }


}


















