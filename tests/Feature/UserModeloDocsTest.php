<?php

//namespace Tests\Feature;


use App\Models\UserModeloDocs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModeloDocsTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

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

        $user_model = factory(App\Models\UserModeloDocs::class, 1)->create();
        $modelo     = UserModeloDocs::first();

        $response = $this->patch('/api/user-modelo-docs-json/' . $modelo->id, [
            'name' => 'novo nome',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''
        ]);

        $this->assertEquals('novo nome', UserModeloDocs::first()->name);

    }

    /** @test */ //SUCESSO
    public function modelo_pode_ser_destruido() {

        $user_model = factory(App\Models\UserModeloDocs::class, 1)->create();
        $this->assertCount(1, UserModeloDocs::all());
        $modelo   = UserModeloDocs::first();

        $response = $this->delete('/api/user-modelo-docs-json/' . $modelo->id);
        $this->assertCount(0, UserModeloDocs::all());
    }

    /** @test */ //SUCESSO
    public function modelo_soft_delete() {

        $user_model = factory(App\Models\UserModeloDocs::class, 1)->create();
        $modelo     = UserModeloDocs::first();

        $response = $this->patch('/api/desativar-user-modelo-docs-json/' . $modelo->id);
        $this->assertEquals(0, UserModeloDocs::first()->active);

    }

}


















