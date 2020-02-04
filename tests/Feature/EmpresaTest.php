<?php

//namespace Tests\Feature;


use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */

    /** @test */
    public function retorna_todas_empresas() {
        //
        $empresa = factory(App\Models\Empresa::class, 5)->create();
        $this->assertCount(5, Empresa::all());

        $response = $this->get('/api/empresa-json');
        $response->assertJsonCount(5);
    }


    public function empresa_pode_ser_adicionada() {

        $empresa = factory(App\Models\Empresa::class, 1)->create();
        $this->assertCount(1, Empresa::all());

    }

    /** @test */ //SUCESSO
    public function empresa_tem_campos_obrigatorios() {

        $response = $this->post('/api/empresa-json', [
            'cpf_cnpj' => '',
            'logo_marca' => ''
        ]);

        $response->assertSessionHasErrors('cpf_cnpj');
        $response->assertSessionHasErrors('logo_marca');


    }

    /** @test */ //SUCESSO
    public function empresa_pode_ser_atualizada() {

        $empresa = factory(App\Models\Empresa::class, 1)->create();
        $empresa = Empresa::first();

        $response = $this->patch('/api/empresa-json/' . $empresa->id, [
            'cpf_cnpj' => 'novo cpf',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

        $this->assertEquals('novo cpf', Empresa::first()->cpf_cnpj);


    }

    /** @test */ //SUCESSO
    public function empresa_pode_ser_destruida() {

        $empresa = factory(App\Models\Empresa::class, 1)->create();
        $this->assertCount(1, Empresa::all());
        $empresa = Empresa::first();

        $response = $this->delete('/api/empresa-json/' . $empresa->id);
        $this->assertCount(0, Empresa::all());
    }

    /** @test */ //SUCESSO
    public function empresa_soft_delete() {

        $empresa = factory(App\Models\Empresa::class, 1)->create();
        $empresa = Empresa::first();

        $response = $this->patch('/api/desativar-empresa-json/' . $empresa->id);
        $this->assertEquals(0, Empresa::first()->active);

    }

}


















