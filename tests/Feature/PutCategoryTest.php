<?php

namespace Tests\Feature;

use Tests\TestCase;

class PutCategoryTest extends TestCase
{
    /**
     *
     */
    public function testPutCategoryAsGuest(): void
    {
        $response = $this->put('/api/categories', [
            'name' => 'Test' . microtime(),
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
    public function testPutCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/categories', [
            'name' => 'Test ' . microtime(),
        ], $headers);

        $response->assertStatus(200) &&
        $response->assertJsonStructure([
            'status',
            'id',
        ]);
    }

    /**
     *
     */
    public function testPutCategoryNonUniqueName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $name = 'Test ' . microtime();

        $this->put('/api/categories', [
            'name' => $name,
        ], $headers);

        $response = $this->put('/api/categories', [
            'name' => $name,
        ], $headers);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testPutCategoryEmptyName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/categories', [], $headers);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testPutCategoryTooLongName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/categories', [
            'name' => str_random(65),
        ], $headers);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
