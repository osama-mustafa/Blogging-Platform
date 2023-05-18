<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_login_page_is_loaded_successfully()
    {
        // Arrange
        $loginRoute = 'login';

        // Act 
        $response = $this->get(route($loginRoute));
        
        // Assert
        $response->assertSee('Login');
    }
}
