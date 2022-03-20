<?php

namespace Tests\Unit;

use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DBTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    //php artisan test --testsuite=Unit --stop-on-failure

    public function test_example()
    {
        // Run a single seeder...
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBasicExample()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('GET', '/test/show/1/2');

        $response
            ->assertStatus(200)
            ->assertSeeText('TestController 1 2');
    }
}
