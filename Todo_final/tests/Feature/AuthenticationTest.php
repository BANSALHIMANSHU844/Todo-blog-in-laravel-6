<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //Adding that @test tells phpunit to treat the function as a test, regardless of the name.
    /** @test */
    public function registerTest()
    {
        
            $this->post('/register', [
                'name' => 'hello',
                'email' => 'hello@gmail.com',
                'password' => 'Password123',
                'password_confirmation' => 'Password123',
            ]);

            $this->assertDatabaseHas('users', [
                'email' => 'hello@gmail.com',
            ]);
    }

    //Adding that @test tells phpunit to treat the function as a test, regardless of the name.
    /** @test */
        public function a_guest_should_be_able_to_see_the_register_page()
    {
        $response = $this->get('/register');
        $response->assertViewIs('auth.register');

    }

    //Adding that @test tells phpunit to treat the function as a test, regardless of the name.
    /** @test */
    public function a_guest_should_be_able_to_see_the_login_page()
    {
        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
    }

        /** @test */
    public function createtodoTest()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $this->post('/todo', [
            'title' => 'php',
            'description' => 'learning',
            'user_id' => '20',
            'status' => 'pending'
        ]);
        $this->assertDatabaseHas('todos', [
            'title' => 'php'
        ]);
    }
}
