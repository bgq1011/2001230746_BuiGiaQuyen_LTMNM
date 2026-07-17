<?php

namespace Tests\Feature;

use Tests\TestCase;

class HelloRouteTest extends TestCase
{
    public function test_hello_route_returns_laravel_12_content(): void
    {
        $response = $this->get('/hello');

        $response->assertOk();
        $response->assertSee('Laravel 12', false);
    }
}