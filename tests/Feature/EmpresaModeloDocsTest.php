<?php

//namespace Tests\Feature;


use App\Models\EmpresaModeloDocs;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaModeloDocsTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todos_modelos_empresa() {
        $modelo = factory(App\Models\EmpresaModeloDocs::class, 5)->create();
        $this->assertCount(5, EmpresaModeloDocs::all());

        $response = $this->get('/api/empresa-modelo-docs-json');
        $response->assertJsonCount(5);
    }

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

        $modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $modelo = EmpresaModeloDocs::first();
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/empresa-modelo-docs-json/' . $modelo->id, [
            'name' => 'novo nome'
        ]);

        $this->assertEquals('novo nome', EmpresaModeloDocs::first()->name);

    }

    /** @test */ //SUCESSO
    public function modelo_pode_ser_destruido() {

        $emp_modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $modelo     = EmpresaModeloDocs::first();
        $this->assertCount(1, EmpresaModeloDocs::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/empresa-modelo-docs-json/' . $modelo->id);
        $this->assertCount(0, EmpresaModeloDocs::all());
    }

    /** @test */ //SUCESSO
    public function modelo_soft_delete() {

        $modelo = factory(App\Models\EmpresaModeloDocs::class, 1)->create();
        $modelo = EmpresaModeloDocs::first();
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-empresa-modelo-docs-json/' . $modelo->id);
        $this->assertEquals(0, EmpresaModeloDocs::first()->active);

    }

}


















