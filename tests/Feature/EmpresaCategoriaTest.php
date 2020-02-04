<?php

//namespace Tests\Feature;


use App\Models\EmpresaCategoria;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaCategoriaTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todas_categorias() {
        //
        $categoria = factory(App\Models\EmpresaCategoria::class, 5)->create();
        $this->assertCount(5, EmpresaCategoria::all());

        $response = $this->get('/api/empresa-categoria-json');
        $response->assertJsonCount(5);

    }

    /** @test */ //SUCESSO
    public function categoria_empresa_pode_ser_criada() {
        //
        $categoria = factory(App\Models\EmpresaCategoria::class, 1)->create();
        $this->assertCount(1, EmpresaCategoria::all());

    }

    /** @test */ //SUCESSO
    public function categoria_empresa_tem_campos_obrigatorios() {

        $response = $this->post('/api/empresa-categoria-json', [
            'name' => '',
            'descricao' => 'descricao obrigatoria',
            'active' => '1'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function categoria_empresa_pode_ser_atualizada() {

        $categoria = factory(App\Models\EmpresaCategoria::class, 1)->create();
        $categoria = EmpresaCategoria::first();
        $user      = factory(App\User::class, 1)->create();
        $user      = User::first();

        $response = $this->actingAs($user)->patch('/api/empresa-categoria-json/' . $categoria->id, [
            'name' => 'novo nome',
            'descricao' => 'nova descricao',
        ]);

        $this->assertEquals('novo nome', EmpresaCategoria::first()->name);
        $this->assertEquals('nova descricao', EmpresaCategoria::first()->descricao);

    }

    /** @test */ //SUCESSO
    public function categoria_pode_ser_destruida() {

        $categoria = factory(App\Models\EmpresaCategoria::class, 1)->create();
        $categoria = EmpresaCategoria::first();
        $this->assertCount(1, EmpresaCategoria::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/empresa-categoria-json/' . $categoria->id);
        $this->assertCount(0, EmpresaCategoria::all());

    }

    /** @test */ //SUCESSO
    public function categoria_soft_delete() {

        $categoria = factory(App\Models\EmpresaCategoria::class, 1)->create();
        $categoria = EmpresaCategoria::first();
        $user      = factory(App\User::class, 1)->create();
        $user      = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-empresa-categoria-json/' . $categoria->id);
        $this->assertEquals(0, EmpresaCategoria::first()->active);
    }


}


















