<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesControllerTest extends TestCase
{
    /**
     * Route::get '/'
     * PagesController@index
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Reserving');

    }

    /**
     * Route::get /asyncLoad
     * PagesController@asyncLoad
     */
    public function testAsyncLoad()
    {
        $response = $this->get('/asyncLoad');
        $response->assertStatus(200);

    }
}
