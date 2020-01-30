<?php

namespace Tests\Feature;


use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function empresa_pode_ser_adicionada() {

        $response = $this->post('/api/empresa-json', [
            'cpf_cnpj' => '123456789',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

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

        $response = $this->post('/api/empresa-json', [
            'cpf_cnpj' => '123456789',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

        $empresa = Empresa::first();

        $response = $this->patch('/api/empresa-json/' . $empresa->id, [
            'cpf_cnpj' => 'novo cpf',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

        $this->assertEquals('novo cpf', Empresa::first()->cpf_cnpj);


    }

    /** @test */ //SUCESSO
    public function empresa_pode_ser_destruida() {

        $response = $this->post('/api/empresa-json', [
            'cpf_cnpj' => '123456789',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

        $this->assertCount(1, Empresa::all());

        $empresa  = Empresa::first();
        $response = $this->delete('/api/empresa-json/' . $empresa->id);
        $this->assertCount(0, Empresa::all());
    }

    /** @test */ //SUCESSO
    public function empresa_soft_delete() {

        $response = $this->post('/api/empresa-json', [
            'cpf_cnpj' => '123456789',
            'logo_marca' => 'logo marca obrigatorio'
        ]);

        $empresa  = Empresa::first();
        $response = $this->patch('/api/desativar-empresa-json/' . $empresa->id);
        $this->assertEquals(0, Empresa::first()->active);

    }

}


















