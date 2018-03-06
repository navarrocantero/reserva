<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesControllerTest extends TestCase
{
    /**
     * Test de la pagina principal '/'
     * @test
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStadtus(200);
        $response->assertSee('Reserving');
    }

    /**
     * Test de la pagina  '/asyncLoad'
     * @test
     * @return void
     */
    public function testAsyncLoad()
    {
        $response = $this->get('/asyncLoad');
        $response->assertStatus(200);

    }
}
