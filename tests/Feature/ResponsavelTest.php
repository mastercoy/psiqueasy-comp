<?php

//namespace Tests\Feature;

use App\Models\Responsavel;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsavelTest extends TestCase {

    use RefreshDatabase;

    //        $this->withoutExceptionHandling();

    /** @test */ //SUCESSO
    public function um_responsavel_pode_ser_adicionado() {

        $responsavel = factory(App\Models\Responsavel::class, 1)->create();
        $this->assertCount(1, Responsavel::all());
    }

    /** @test */ //SUCESSO
    public function nome_responsavel_deve_ser_obrigatorio() {

        $response = $this->post('/api/responsavel-json', [
            'name' => '',
            'parentesco' => 'irmão'
        ]);

        $response->assertSessionHasErrors('name');

    }

    /** @test */ //SUCESSO
    public function responsavel_pode_ser_atualizado() {

        $responsavel = factory(App\Models\Responsavel::class, 1)->create();
        $responsavel = Responsavel::first();
        $user        = factory(App\User::class, 1)->create();
        $user        = User::first();

        $response = $this->actingAs($user)->patch('/api/responsavel-json/' . $responsavel->id, [
            'name' => 'novo nome',
            'parentesco' => 'pai',
            'end' => 'novo endereço'
        ]);

        $this->assertEquals('novo nome', Responsavel::first()->name);

    }

    /** @test */
    public function responsavel_pode_ser_destruido() {

        $responsavel = factory(App\Models\Responsavel::class, 1)->create();
        $responsavel = Responsavel::first();
        $this->assertCount(1, Responsavel::all());

        $user = factory(App\User::class, 1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->delete('/api/responsavel-json/' . $responsavel->id);
        $this->assertCount(0, Responsavel::all());


    }

    /** @test */ //SUCESSO
    public function responsavel_soft_delete() {

        $responsavel = factory(App\Models\Responsavel::class, 1)->create();
        $responsavel = Responsavel::first();
        $user        = factory(App\User::class, 1)->create();
        $user        = User::first();

        $response = $this->actingAs($user)->patch('/api/desativar-responsavel-json/' . $responsavel->id);
        $this->assertEquals(0, Responsavel::first()->active);


    }

    /** @test */ //SUCESSO
    public function retorna_responsaveis_soft_delete() {
//        $this->withoutExceptionHandling();

        $user        = factory(App\User::class, 1)->create();
        $responsavel = factory(App\Models\Responsavel::class, 2)->create(['active' => false]);
        $responsavel = factory(App\Models\Responsavel::class, 1)->create();

        $this->assertCount(3, Responsavel::all());
        $this->assertCount(1, User::all());

        $user = User::first();

        $response = $this->get('/api/excluidos-responsavel-json/' . $user->id);

        $response->assertJsonCount(2);

    }
}
