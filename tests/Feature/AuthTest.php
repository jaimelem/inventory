<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->post(route('/action-login', ['email'=>'jaime@example.com', 'password'=>'12345']));
        $response->assertStatus(302)->assertRedirect(route('/action-login'));
    }

    public function test_register(): void
    {
        $response = $this->post(route('/action-register', ['name'=>'prueba01', 'email'=>'prueba@gmail.com',
         'password'=> Hash::make('0000'), 'email_verified_at'=> now(), 'created_at' => now(),
         'updated_at' => now(), 'remember_token' => Str::random(10)]));
        $response->assertStatus(302)->assertRedirect(route('/products'));
    }
}
