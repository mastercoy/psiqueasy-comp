<?php

//namespace Tests\Feature;


use App\Models\Userpermissao;
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

    /** @test */ //SUCESSO
    public function user_permissao_pode_ser_criada() {

        $permissao = factory(App\Models\UserPermissao::class, 1)->create();
        $this->assertCount(1, UserPermissao::all());

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


















