<?php


use App\Models\PerfilPermissaoPivot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PerfilPermissaoPivotTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todas_permissoes_pivot() {
        //
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '2',
            'userpermissao_id' => '2'
        ]);
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '3',
            'userpermissao_id' => '1'
        ]);
        $this->assertCount(3, PerfilPermissaoPivot::all());

//        $response = $this->get('/api/perfil-permissao-pivot-json');
//        $response->assertJsonCount(3);
    }

    /** @test */ //SUCESSO
    public function pivot_permissao_pode_ser_criado() {
        //
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $this->assertCount(1, PerfilPermissaoPivot::all());


    }

    public function pivot_permissao_show() {
        //
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $this->assertCount(1, PerfilPermissaoPivot::all());

        $pivot    = PerfilPermissaoPivot::first();
        $response = $this->get('/api/perfil-permissao-pivot-json/' . $pivot->id);
        $response->assertJsonCount(1);

    }

    /** @test */ //SUCESSO
    public function pivot_perfil_pode_ser_atualizado() {
        //
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $this->assertCount(1, PerfilPermissaoPivot::all());

        $pivot    = PerfilPermissaoPivot::first();
        $response = $this->patch('/api/perfil-permissao-pivot-json/' . $pivot->id, [
            'userperfil_id' => '2',
            'userpermissao_id' => '2'
        ]);
        $this->assertCount(1, PerfilPermissaoPivot::all());

        $this->assertEquals('2', PerfilPermissaoPivot::first()->userperfil_id);

    }

    /** @test */ //SUCESSO
    public function pivot_perfil_pode_ser_destruido() {
        //
        $response = $this->post('/api/perfil-permissao-pivot-json', [
            'userperfil_id' => '1',
            'userpermissao_id' => '1'
        ]);
        $this->assertCount(1, PerfilPermissaoPivot::all());

        $pivot = PerfilPermissaoPivot::first();

        $response = $this->delete('/api/perfil-permissao-pivot-json/' . $pivot->id);
        $this->assertCount(0, PerfilPermissaoPivot::all());


    }


}


















