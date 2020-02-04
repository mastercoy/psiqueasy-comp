<?php


use App\Models\EmpresaFilial;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilialTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todas_filiais() {
        //
        $filial = factory(App\Models\EmpresaFilial::class, 5)->create();
        $this->assertCount(5, EmpresaFilial::all());

        $response = $this->get('/api/empresa-filial-json');
        $response->assertJsonCount(5);
    }

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
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/empresa-filial-json/' . $filial->id, [
            'name' => 'novo nome',
        ]);

        $this->assertEquals('novo nome', EmpresaFilial::first()->name);

    }

    /** @test */ //SUCESSO
    public function filial_pode_ser_destruida() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $filial = EmpresaFilial::first();
        $this->assertCount(1, EmpresaFilial::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/empresa-filial-json/' . $filial->id);
        $this->assertCount(0, EmpresaFilial::all());


    }

    /** @test */ //SUCESSO
    public function filial_soft_delete() {

        $filial = factory(App\Models\EmpresaFilial::class, 1)->create();
        $filial = EmpresaFilial::first();
        $user   = factory(App\User::class, 1)->create();
        $user   = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-empresa-filial-json/' . $filial->id);
        $this->assertEquals(0, EmpresaFilial::first()->active);

    }
}


















