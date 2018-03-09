<?php

namespace Tests\Feature;

use App\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeaturesControllerTest extends TestCase
{
    /**
     * Route::get /feature/{slugname}
     * FeatureController@index
     */
    public function testIndex()
    {
        $feature = (factory(Feature::class, 1)->create())->first();
        $response = $this->get('/feature/'.$feature->slugname);
        $response->assertStatus(200);
        $response->assertSee('Categoria');
    }
}
