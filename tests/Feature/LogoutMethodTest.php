<?php

namespace Tests\Feature;

use Tests\TestCase;

class LogoutMethodTest extends TestCase
{
    /**
     *
     */
    public function testLogoutAsGuest(): void
    {
        $response = $this->post('/api/logout');

        $response->assertStatus(401) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLogout(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->post('/api/logout', [], $headers);

        $response->assertStatus(200) &&
        $response->assertJsonStructure([
            'status',
        ]);
    }

    /**
     *
     */
    public function testLogoutWrongToken(): void
    {
        $headers = [
            'Authorization' => 'Bearer ' . str_random(100)
        ];

        $response = $this->post('/api/logout', [], $headers);

        $response->assertStatus(401) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
