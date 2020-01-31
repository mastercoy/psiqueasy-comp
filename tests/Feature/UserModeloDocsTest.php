<?php

namespace Tests\Feature;


use App\Models\UserModeloDocs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModeloDocsTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function modelo_user_pode_ser_criado() {

        $response = $this->post('/api/criar-user-modelos-json', [
            'name' => 'nome modelo',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''
        ]);

        $this->assertCount(1, UserModeloDocs::all());

    }

    /** @test */ //SUCESSO
    public function modelo_users_tem_campos_obrigatorios() {

        $response = $this->post('/api/criar-user-modelos-json', [
            'name' => '',

        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function modelo_user_pode_ser_atualizado() {

        $response = $this->post('/api/criar-user-modelos-json', [
            'name' => 'nome modelo',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''
        ]);

        $modelo   = UserModeloDocs::first();
        $response = $this->patch('/api/editar-user-modelos-json/' . $modelo->id, [
            'name' => 'novo nome',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''
        ]);

        $this->assertEquals('novo nome', UserModeloDocs::first()->name);

    }

    /** @test */ //SUCESSO
    public function modelo_pode_ser_destruido() {

        $response = $this->post('/api/criar-user-modelos-json', [
            'name' => 'nome modelo',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''
        ]);

        $this->assertCount(1, UserModeloDocs::all());

        $modelo   = UserModeloDocs::first();
        $response = $this->delete('/api/destruir-user-modelos-json/' . $modelo->id);
        $this->assertCount(0, UserModeloDocs::all());
    }

    /** @test */ //SUCESSO
    public function modelo_soft_delete() {

        $response = $this->post('/api/criar-user-modelos-json', [
            'name' => 'nome modelo',
            'conteudo' => '',
            'active' => '1',
            'user_id' => ''

        ]);

        $modelo   = UserModeloDocs::first();
        $response = $this->patch('/api/desativar-user-modelos-json/' . $modelo->id);

        $this->assertEquals(0, UserModeloDocs::first()->active);

    }

}


















