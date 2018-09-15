<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginMethodTest extends TestCase
{
    /**
     *
     */
    public function testLogin(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ]);

        $response->assertStatus(200) &&
        $response->assertJsonStructure([
            'status',
            'accessToken',
            'tokenType',
            'expiresAt'
        ]);
    }

    /**
     *
     */
    public function testLoginNoEmail(): void
    {
        $response = $this->post('/api/login', [
            'password' => '12345'
        ]);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLoginWrongEmail(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test2.com',
            'password' => '12345'
        ]);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLoginIncorrectEmail(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'testtest.com',
            'password' => '12345'
        ]);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLoginNoPassword(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLoginWrongPassword(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '01234'
        ]);

        $response->assertStatus(401) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testLoginNoParams(): void
    {
        $response = $this->post('/api/login', []);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
