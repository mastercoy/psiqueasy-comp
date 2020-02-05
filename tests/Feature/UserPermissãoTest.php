<?php

//namespace Tests\Feature;


use App\Models\UserPerfil;
use App\Models\Userpermissao;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPermissaoTest extends TestCase {


    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todas_permissoes_usuario() {
        //
        $permissao = factory(App\Models\UserPermissao::class, 5)->create();
        $this->assertCount(5, UserPermissao::all());

        $response = $this->get('/api/user-permissao-json');
        $response->assertJsonCount(5);
    }

    /** @test */
    public function user_permissao_pode_ser_criada() {
        //afazer continuar o teste
        //cria um user user->id = 1 , NYLO
        $response = $this->post('/api/user-json', [
            'name' => 'Nylo',
            'email' => 'nylo@nylo.com',
            'password' => '123456',
            'formacao' => 'estudante'
        ]);
        $user     = User::first();
        $this->assertCount(1, User::all());

        //cria um perfil user_id-> = 1, MASTER
        $response = $this->post('/api/user-perfil-json', [
            'name' => 'Master',
            'label' => 'Master',
            'active' => '1',
            'user_id' => '1',

        ]);
        $perfil   = UserPerfil::first();
        $this->assertCount(1, UserPerfil::all());

        //cria três permissões ID 1-2-3
        $response = $this->post('/api/user-permissao-json', [
            'name' => 'paciente_in',
            'label' => 'Cadastrar Paciente',
            'active' => 1
        ]);
        $response = $this->post('/api/user-permissao-json', [
            'name' => 'paciente_out',
            'label' => 'Remover Paciente',
            'active' => 1
        ]);
        $response = $this->post('/api/user-permissao-json', [
            'name' => 'paciente_edit',
            'label' => 'Editar Paciente',
            'active' => 1
        ]);
        $this->assertCount(3, Userpermissao::all());

        // NYLO É MASTER
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);

        //MASTER TEM 3 PERMISSOES
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '2'
        ]);
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '3'
        ]);

        // pegar id do usuario
        // ver qual o perfil
        // ver quais permissões
        //
        $usuario    = User::first();
        $json       = $usuario->toJson();
        $array      = $usuario->toArray();
        $serialized = serialize($usuario);
        dd($serialized);

    }

    /** @test */ //SUCESSO
    public function user_permissao_tem_campos_obrigatorios() {

        $response = $this->post('/api/user-permissao-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_atualizada() {

        $permissao = factory(App\Models\UserPermissao::class, 1)->create();
        $this->assertCount(1, UserPermissao::all());
        $permissao = UserPermissao::first();

        $response = $this->patch('/api/user-permissao-json/' . $permissao->id, [
            'name' => 'novo nome',
            'active' => '1',
        ]);

        $this->assertEquals('novo nome', Userpermissao::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_destruida() {

        $permissao = factory(App\Models\UserPermissao::class, 1)->create();
        $this->assertCount(1, UserPermissao::all());
        $permissao = UserPermissao::first();

        $response  = $this->delete('/api/user-permissao-json/' . $permissao->id);
        $this->assertCount(0, UserPermissao::all());
    }

    /** @test */ //SUCESSO
    public function user_permissao_soft_delete() {

        $permissao = factory(App\Models\UserPermissao::class, 1)->create();
        $permissao = UserPermissao::first();

        $response  = $this->patch('/api/desativar-user-permissao-json/' . $permissao->id);
        $this->assertEquals(0, UserPermissao::first()->active);
    }


}


















