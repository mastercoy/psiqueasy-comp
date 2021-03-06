<?php

//namespace Tests\Feature;


use App\Models\UserModeloDocs;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModeloDocsTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todos_modelos_user() {
        //
        $modelo = factory(App\Models\UserModeloDocs::class, 5)->create();
        $this->assertCount(5, UserModeloDocs::all());

        $response = $this->get('/api/user-modelo-docs-json');
        $response->assertJsonCount(5);

    }

    /** @test */ //SUCESSO
    public function modelo_user_pode_ser_criado() {

        $user_model = factory(App\Models\UserModeloDocs::class, 1)->create();
        $this->assertCount(1, UserModeloDocs::all());

    }

    /** @test */ //SUCESSO
    public function modelo_users_tem_campos_obrigatorios() {

        $response = $this->post('/api/user-modelo-docs-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function modelo_user_pode_ser_atualizado() {

        $modelo = factory(App\Models\UserModeloDocs::class, 1)->create();
        $modelo = UserModeloDocs::first();
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/user-modelo-docs-json/' . $modelo->id, [
            'name' => 'novo nome',
            'conteudo' => '',
            'active' => '1',
            'user_id' => '1'
        ]);

        $this->assertEquals('novo nome', UserModeloDocs::first()->name);

    }

    /** @test */ //SUCESSO
    public function modelo_pode_ser_destruido() {

        $modelo = factory(App\Models\UserModeloDocs::class, 1)->create();
        $modelo = UserModeloDocs::first();
        $this->assertCount(1, UserModeloDocs::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/user-modelo-docs-json/' . $modelo->id);
        $this->assertCount(0, UserModeloDocs::all());
    }

    /** @test */ //SUCESSO
    public function modelo_soft_delete() {

        $modelo = factory(App\Models\UserModeloDocs::class, 1)->create();
        $modelo = UserModeloDocs::first();
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-user-modelo-docs-json/' . $modelo->id);
        $this->assertEquals(0, UserModeloDocs::first()->active);

    }

}


















