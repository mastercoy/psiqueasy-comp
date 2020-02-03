<?php

//namespace Tests\Feature;


use App\Models\EmpresaModeloDocs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaModeloDocsTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function modelo_empresa_pode_ser_criado() {

        $emp_modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $this->assertCount(1, EmpresaModeloDocs::all());

    }

    /** @test */ //SUCESSO
    public function modelo_empresas_tem_campos_obrigatorios() {

        $response = $this->post('/api/empresa-modelo-docs-json', [
            'name' => '',

        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function modelo_empresa_pode_ser_atualizado() {

        $emp_modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $modelo     = EmpresaModeloDocs::first();

        $response = $this->patch('/api/empresa-modelo-docs-json/' . $modelo->id, [
            'name' => 'novo nome',
            'empresa_id' => '1'
        ]);

        $this->assertEquals('novo nome', EmpresaModeloDocs::first()->name);

    }

    /** @test */ //SUCESSO
    public function modelo_pode_ser_destruido() {

        $emp_modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $this->assertCount(1, EmpresaModeloDocs::all());
        $modelo   = EmpresaModeloDocs::first();

        $response = $this->delete('/api/empresa-modelo-docs-json/' . $modelo->id);
        $this->assertCount(0, EmpresaModeloDocs::all());
    }

    /** @test */ //SUCESSO
    public function modelo_soft_delete() {

        $emp_modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();

        $modelo   = EmpresaModeloDocs::first();
        $response = $this->patch('/api/desativar-empresa-modelo-docs-json/' . $modelo->id);

        $this->assertEquals(0, EmpresaModeloDocs::first()->active);

    }

}


















