<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->json('POST', 'api/paciente/gerar-relatorio-word/atendimentos/1',
          ['list_atendimentos' => 'Sally']
        );

        $response->assertJson([
                'atendimentos' => 'ok'
            ]);
    }
}
