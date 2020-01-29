<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //obs SUCESSO
    public function user_pode_ser_adicionado() { //name e pass

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $user = User::first();
        $this->assertCount(1, User::all());

    }

    /** @test */ //obs SUCESSO
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

    /** @test */ //obs SUCESSO
    public function user_pode_ser_atualizado() {

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $user     = User::first();
        $response = $this->patch('/api/user-json/' . $user->id, [
            'name' => 'novo nome',
            'email' => $user->email,
            'password' => $user->password
        ]);

        dd(User::first());
        $this->assertEquals('novo nome', User::first()->name);

    }

    /** @test */ //obs SUCESSO
    public function user_pode_ser_destruido() {

        $response = $this->post('/api/user-json', [
            'name' => 'obrigatorio',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $this->assertCount(1, User::all());
        $user     = User::first();
        $response = $this->delete('/api/user-json/' . $user->id);
        $this->assertCount(0, User::all());
    }


}
