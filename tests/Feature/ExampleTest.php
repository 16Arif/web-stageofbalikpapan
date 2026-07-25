<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_kalimantan_earthquakes_page_returns_a_successful_response(): void
    {
        $response = $this->get('/gempabumi/kalimantan');

        $response->assertStatus(200);
    }

    public function test_the_lightning_page_returns_a_successful_response(): void
    {
        $response = $this->get('/geofisika/petir');

        $response->assertStatus(200);
    }
}
