<?php

namespace Tests\Feature;


use App\Models\EmpresaCategoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaCategoriaTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function categoria_empresa_pode_ser_criada() {

        $response = $this->post('/api/criar-empresa-categoria-json', [
            'name' => 'nome obrigatorio',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $this->assertCount(1, EmpresaCategoria::all());

    }

    /** @test */ //SUCESSO
    public function categoria_empresa_tem_campos_obrigatorios() {

        $response = $this->post('/api/criar-empresa-categoria-json', [
            'name' => '',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function categoria_empresa_pode_ser_atualizada() {

        $response = $this->post('/api/criar-empresa-categoria-json', [
            'name' => 'nome obrigatorio',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $categoria = EmpresaCategoria::first();

        $response = $this->patch('/api/editar-empresa-categoria-json/' . $categoria->id, [
            'name' => 'novo nome',
            'descricao' => 'nova descricao',
        ]);

        $this->assertEquals('novo nome', EmpresaCategoria::first()->name);
        $this->assertEquals('nova descricao', EmpresaCategoria::first()->descricao);

    }

    /** @test */ //SUCESSO
    public function categoria_pode_ser_destruida() {
        $response = $this->post('/api/criar-empresa-categoria-json', [
            'name' => 'nome obrigatorio',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $this->assertCount(1, EmpresaCategoria::all());

        $categoria = EmpresaCategoria::first();
        $response  = $this->delete('/api/destruir-empresa-categoria-json/' . $categoria->id);
        $this->assertCount(0, EmpresaCategoria::all());

    }

    /** @test */ //SUCESSO
    public function categoria_soft_delete() {

        $response = $this->post('/api/criar-empresa-categoria-json', [
            'name' => 'nome obrigatorio',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $categoria = EmpresaCategoria::first();
        $response  = $this->patch('/api/desativar-empresa-categoria-json/' . $categoria->id);
        $this->assertEquals(0, EmpresaCategoria::first()->active);
    }


}


















