<?php

//namespace Tests\Feature;


use App\Models\EmpresaFilial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilialTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function filial_pode_ser_criada() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $this->assertCount(1, EmpresaFilial::all());

    }

    /** @test */ //SUCESSO
    public function filial_tem_campos_obrigatorios() {

        $response = $this->post('/api/empresa-filial-json', [
            'name' => ''

        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function filial_pode_ser_atualizada() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $filial = EmpresaFilial::first();

        $response = $this->patch('/api/empresa-filial-json/' . $filial->id, [
            'name' => 'novo nome',
            'empresa_id' => '1'
        ]);

        $this->assertEquals('novo nome', EmpresaFilial::first()->name);

    }

    /** @test */ //SUCESSO
    public function filial_pode_ser_destruida() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $this->assertCount(1, EmpresaFilial::all());
        $filial   = EmpresaFilial::first();

        $response = $this->delete('/api/empresa-filial-json/' . $filial->id);
        $this->assertCount(0, EmpresaFilial::all());


    }

    /** @test */ //SUCESSO
    public function filial_soft_delete() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $filial = EmpresaFilial::first();

        $response = $this->patch('/api/desativar-empresa-filial-json/' . $filial->id);
        $this->assertEquals(0, EmpresaFilial::first()->active);

    }
}


















