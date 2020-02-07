<?php

//namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */
    public function retorna_todos_usuarios() {
        //
        $user = factory(App\User::class, 5)->create();
        $this->assertCount(5, User::all());

        $response = $this->get('/api/user-json');
//        $response->assertJsonCount(5);
    }

    /** @test */ //SUCESSO
    public function user_pode_ser_adicionado() {

        $user = factory(App\User::class, 1)->create();
        $user = User::first();
        $this->assertCount(1, User::all());

    }

    /** @test */
    public function user_show() {
        //
        $response = $this->post('/api/user-json', [
            'name' => 'nylo',
            'email' => 'teste@test',
            'password' => '1111111',
            'formacao' => 'estudante'
        ]);
        $this->assertCount(1, User::all());

        $user_json = User::first();

        $response = $this->get('api/user-json/' . $user_json->id);
//        dd($response);
//        $response->assertJsonCount(1);


    }

    /** @test */ //SUCESSO
    public function campos_sao_obrigatorios() {

        $response = $this->post('/api/user-json', [
            'name' => '',
            'email' => '',
            'password' => '',
            'formacao' => 'estudante'
        ]);

        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');

    }

    /** @test */ //SUCESSO
    public function user_pode_ser_atualizado() {

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->patch('/api/user-json/' . $user->id, [
            'name' => 'novo nome',
            'email' => $user->email,
            'password' => $user->password
        ]);

        $this->assertEquals('novo nome', User::first()->name);

    }

    /** @test */ //SUCESSO
    public function user_pode_ser_destruido() {

        $user = factory(App\User::class, 1)->create();
        $this->assertCount(1, User::all());
        $user     = User::first();

        $response = $this->delete('/api/user-json/' . $user->id);
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function user_soft_delete() {

        $response = factory(App\User::class, 1)->create();
        $user     = User::first();

        $response = $this->patch('/api/desativar-user-json/' . $user->id);
        $this->assertEquals(0, User::first()->active);

    }

}
