<?php

namespace Tests\Feature;

use Tests\TestCase;

class PatchProductTest extends TestCase
{
    /**
     *
     */
    public function testPatchProductAsGuest(): void
    {
        $response = $this->patch('/api/products/1', [
            'name' => 'Test 11q',
            'categories[0]' => 1,
            'price' => 300
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
    public function testPatchProduct(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test 11q',
            'categories' => [1, 2],
            'price' => 200
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
    public function testPatchProductWrongId(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/10000', [
            'name' => 'Test tt4',
            'categories' => [1],
            'price' => 300
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
    public function testPatchProductNonUniqueName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test',
            'categories' => [1],
            'price' => 300
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
    public function testPatchProductEmptyName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'categories' => [1],
            'price' => 300
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
    public function testPatchProductEmptyCategories(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'price' => 300
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
    public function testPatchProductEmptyPrice(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'categories' => [1],
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
    public function testPatchProductNoParams(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
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
    public function testPatchProductTooLongName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => str_random(65),
            'categories' => [1],
            'price' => 300
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
    public function testPatchProductCategoriesNotArray(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'categories' => 1,
            'price' => 300
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
    public function testPatchProductCategoryIsNaN(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'categories' => ['abc'],
            'price' => 300
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
    public function testPatchProductWrongCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'categories' => [1000],
            'price' => 300
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
    public function testPatchProductPriceIsNan(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->patch('/api/products/1', [
            'name' => 'Test ' . microtime(),
            'categories' => [1],
            'price' => 'abc'
        ], $headers);

        $response->assertStatus(400) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
