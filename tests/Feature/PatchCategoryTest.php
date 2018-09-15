<?php

namespace Tests\Feature;

use Tests\TestCase;

class PatchCategoryTest extends TestCase
{
    /**
     *
     */
    public function testPatchCategoryAsGuest(): void
    {
        $response = $this->patch('/api/categories/1', [
            'name' => 'Test ' . microtime(),
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
    public function testPatchCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/categories/1', [
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
    public function testPatchCategoryWrongId(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/categories/10000', [
            'name' => 'Test ' . microtime(),
        ], $headers);

        $response->assertStatus(404) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testPatchCategoryNonUniqueName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/categories/1', [
            'name' => 'Test',
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
    public function testPatchCategoryEmptyName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/categories/1', [
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
    public function testPatchCategoryTooLongName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/categories/1', [
            'name' => str_random(65),
        ], $headers);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
