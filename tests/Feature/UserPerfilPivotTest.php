<?php


use App\Models\EmpresaFilial;
use App\Models\UserPerfilPivot;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPerfilPivotTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todas_perfis_pivot() {
        //
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '2',
            'userperfil_id' => '2'
        ]);
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '3',
            'userperfil_id' => '1'
        ]);
        $this->assertCount(3, UserPerfilPivot::all());

        $response = $this->get('/api/user-perfil-pivot-json');
        $response->assertJsonCount(3);
    }

    /** @test */ //SUCESSO
    public function pivot_perfil_pode_ser_criado() {
        //
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);
        $this->assertCount(1, UserPerfilPivot::all());


    }


    public function pivot_perfil_show() {
        //
        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);
        $this->assertCount(1, UserPerfilPivot::all());

        $pivot    = UserPerfilPivot::first();
        $response = $this->get('/api/user-perfil-pivot-json/' . $pivot->id);
//        dd($response);
        $this->assertCount(1, UserPerfilPivot::all());
//        $response->assertJsonCount(1);

    }

    /** @test */ //SUCESSO
    public function pivot_perfil_pode_ser_atualizado() {

        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);
        $this->assertCount(1, UserPerfilPivot::all());

        $perfil   = UserPerfilPivot::first();
        $response = $this->patch('/api/user-perfil-pivot-json/' . $perfil->id, [
            'user_id' => '2',
            'userperfil_id' => '2'
        ]);
        $this->assertCount(1, UserPerfilPivot::all());

        $this->assertEquals('2', UserPerfilPivot::first()->userperfil_id);

    }

    /** @test */ //SUCESSO
    public function pivot_perfil_pode_ser_destruido() {

        $response = $this->post('/api/user-perfil-pivot-json', [
            'user_id' => '1',
            'userperfil_id' => '1'
        ]);
        $this->assertCount(1, UserPerfilPivot::all());
        $perfil = UserPerfilPivot::first();

        $response = $this->delete('/api/user-perfil-pivot-json/' . $perfil->id);
        $this->assertCount(0, UserPerfilPivot::all());


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


















