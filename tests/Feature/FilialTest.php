<?php

namespace Tests\Feature;


use App\Models\EmpresaFilial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilialTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function filial_pode_ser_criada() {

        $response = $this->post('/api/criar-filial-json', [
            'name' => 'nome obrigatorio',
            'empresa_id' => ''

        ]);

        $this->assertCount(1, EmpresaFilial::all());

    }

    /** @test */ //SUCESSO
    public function filial_tem_campos_obrigatorios() {

        $response = $this->post('/api/criar-filial-json', [
            'name' => ''

        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function filial_pode_ser_atualizada() {

        $response = $this->post('/api/criar-filial-json', [
            'name' => 'nome obrigatorio',
            'empresa_id' => ''

        ]);

        $filial   = EmpresaFilial::first();
        $response = $this->patch('/api/editar-filial-json/' . $filial->id, [
            'name' => 'novo nome',
            'empresa_id' => '1'
        ]);

        $this->assertEquals('novo nome', EmpresaFilial::first()->name);

    }

    /** @test */ //SUCESSO
    public function filial_pode_ser_destruida() {

        $response = $this->post('/api/criar-filial-json', [
            'name' => 'nome obrigatorio',
            'empresa_id' => ''

        ]);

        $this->assertCount(1, EmpresaFilial::all());
        $filial   = EmpresaFilial::first();
        $response = $this->delete('/api/destruir-filial-json/' . $filial->id);
        $this->assertCount(0, EmpresaFilial::all());


    }

    /** @test */ //SUCESSO
    public function filial_soft_delete() {

        $response = $this->post('/api/criar-filial-json', [
            'name' => 'nome obrigatorio',
            'empresa_id' => '1',

        ]);

        $filial   = EmpresaFilial::first();
        $response = $this->patch('/api/desativar-filial-json/' . $filial->id);

//        dd(EmpresaFilial::first());
        $this->assertEquals(0, EmpresaFilial::first()->active);

    }
}


















