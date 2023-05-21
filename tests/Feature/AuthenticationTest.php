<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use RefreshDatabase;
    private $user;
    private $loginRoute = 'login';
    private $registerRoute = 'register';
    private $logoutRoute = 'logout';


    public function setUp() : void
    {
        parent::setUp();
        $this->user = createUserForTesting('test_first_user', 'test_firet_user@gmail.com');
    }

    public function test_login_page_is_loaded_successfully()
    {
        // Arrange

        // Act 
        $response = $this->get(route($this->loginRoute));
        
        // Assert
        $response->assertOk();
        $response->assertViewIs('auth.login');
        $response->assertSeeText('Login');
    }

    public function test_register_page_is_loaded_successfully()
    {
        // Arrange

        // Act
        $response = $this->get(route($this->registerRoute));

        // Arrange
        $response->assertOk();
        $response->assertViewIs('auth.register');
        $response->assertSeeText('Register');
    }

    public function test_guest_user_can_register_an_account()
    {
        // Arrange
        $userData = [
            'name' => 'first_user',
            'email' => 'test_email@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        // Act
        $response = $this->post(route($this->registerRoute), $userData);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'first_user',
            'email' => 'test_email@gmail.com'
        ]);
    }

    public function test_guest_cannot_register_an_account_without_email()
    {
        // Arrange
        $userData = [
            'name' => 'first_user',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        // Act
        $response = $this->post(route($this->registerRoute), $userData);

        // Assert
        $response->assertInvalid('email');
        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);

    }

    public function test_guest_should_confirm_password_when_create_a_new_account()
    {
        // Arrange
        $userData = [
            'name' => 'first_user',
            'email' => 'test_email@gmail.com',
            'password' => '12345678',
        ];

        // Act
        $response = $this->post(route($this->registerRoute), $userData);

        // Assert
        $response->assertInvalid('password');
        $response->assertSessionHasErrors([
            'password' => 'The password confirmation does not match.'
        ]);
        
    }

    public function test_authenticated_user_cannot_access_register_page()
    {
        // Arrange

        // Act
        $response = $this->actingAs($this->user)->get(route('home'));
        $response = $this->actingAs($this->user)->get(route($this->registerRoute));


        // Assert
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
    }

    public function test_authenticated_user_cannot_access_login_page()
    {
        // Arrange

        // Act
        $response = $this->actingAs($this->user)->get(route('home'));
        $response = $this->actingAs($this->user)->get($this->loginRoute);

        //
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');


    }

    public function test_authenticated_user_can_logout()
    {
        // Arrange

        // Act
        $response = $this->actingAs($this->user)->post(route('logout'));

        // Assert
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function tearDown() : void
    {
        if ($this->user) {
            $this->user->delete();
        }
        parent::tearDown();
    }
}
