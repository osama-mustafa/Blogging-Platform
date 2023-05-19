<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use RefreshDatabase;
    private $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = createUserForTesting('test_firet_user', 'test_firet_user@gmail.com');
    }

    public function test_login_page_is_loaded_successfully()
    {
        // Arrange
        $loginRoute = 'login';

        // Act 
        $response = $this->get(route($loginRoute));
        
        // Assert
        $response->assertOk();
        $response->assertViewIs('auth.login');
        $response->assertSeeText('Login');
    }

    public function test_register_page_is_loaded_successfully()
    {
        // Arrange
        $registerRoute = 'register';

        // Act
        $response = $this->get(route($registerRoute));

        // Arrange
        $response->assertOk();
        $response->assertViewIs('auth.register');
        $response->assertSeeText('Register');
    }

    public function test_guest_user_can_register_an_account()
    {
        // Arrange
        $data = [
            'name' => 'first_user',
            'email' => 'test_email@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];
        $registerRoute = 'register';

        // Act
        $response = $this->post(route($registerRoute), $data);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'first_user',
            'email' => 'test_email@gmail.com'
        ]);
    }

    public function tearDown() : void
    {
        if ($this->user) {
            $this->user->delete();
        }
        parent::tearDown();
    }
}
