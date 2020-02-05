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

    //fixme
    public function user_permissao_pode_ser_criada() {

        //cria um user
        $response = $this->post('/api/user-json', [
            'name' => 'Nylo',
            'email' => 'nylo@nylo.com',
            'password' => '123456',
            'formacao' => 'estudante'
        ]);
        $user     = User::first();
        $this->assertCount(1, User::all());

        //cria um perfil
        $response = $this->post('/api/user-perfil-json', [
            'name' => 'Master',
            'label' => 'Master',
            'active' => '1',
            'user_id' => '1',

        ]);
        $perfil   = UserPerfil::first();
        $this->assertCount(1, UserPerfil::all());

        //cria uma permissão
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
//        $permissao = Userpermissao::first();
        $this->assertCount(3, Userpermissao::all());

        /*$permissao = Userpermissao::first();
        dd($permissao);*/
        /*$permissao = factory(App\Models\UserPermissao::class, 1)->create();
        $this->assertCount(1, UserPermissao::all());*/

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


















