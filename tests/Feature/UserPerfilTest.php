<?php


use App\Models\UserPerfil;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPerfilTest extends TestCase {
    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_criado() {

        $user = factory(App\Models\UserPerfil::class, 1)->create();

        $this->assertCount(1, UserPerfil::all());

    }

    /** @test */ //SUCESSO
    public function user_perfil_tem_campos_obrigatorios() {

        $response = $this->post('/api/user-perfil-json', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_atualizado() {

        $user = factory(App\User::class, 1)->create();

        $perfil = factory(App\Models\UserPerfil::class, 1)->create();

        $perfil   = UserPerfil::first();
        $user     = User::first();
        $response = $this->actingAs($user)->patch('/api/user-perfil-json/' . $perfil->id, [
            'name' => 'novo nome',

        ]);

        $this->assertEquals('novo nome', UserPerfil::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_perfil_pode_ser_destruido() {

        $user   = factory(App\User::class, 1)->create();
        $perfil = factory(App\Models\UserPerfil::class, 1)->create();

        $this->assertCount(1, User::all());
        $this->assertCount(1, UserPerfil::all());

        $user   = User::first();
        $perfil = UserPerfil::first();

        $response = $this->actingAs($user)->delete('/api/user-perfil-json/' . $perfil->id);

        $this->assertCount(0, UserPerfil::all());
    }

    /** @test */ //SUCESSO
    public function user_perfil_soft_delete() {

        $user   = factory(App\User::class, 1)->create();
        $perfil = factory(App\Models\UserPerfil::class, 1)->create();

        $user   = User::first();
        $perfil = UserPerfil::first();

        $response = $this->actingAs($user)->patch('/api/desativar-user-perfil-json/' . $perfil->id);
        $this->assertEquals(0, UserPerfil::first()->active);
    }

    /** @test */ //SUCESSO
    public function update_obedece_gate_recusado() {
//        $this->withoutExceptionHandling();

        $user   = factory(App\User::class, 2)->create();
        $perfil = factory(App\Models\UserPerfil::class, 1)->create();

        $this->assertCount(2, User::all());

        $user   = User::find(2);
        $perfil = UserPerfil::first();

        $response = $this->actingAs($user)->patch('/api/user-perfil-json/' . $perfil->id, [
            'name' => 'novo nome',

        ]);

        $this->assertNotEquals('novo nome', UserPerfil::first()->name);

    }

}

















