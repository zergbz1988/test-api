<?php

namespace Tests\Feature;

use Tests\TestCase;

class PutProductTest extends TestCase
{
    /**
     *
     */
    public function testPutProductAsGuest(): void
    {
        $response = $this->put('/api/products', [
            'name' => 'Test' . microtime(),
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
    public function testPutProduct(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
            'name' => 'Test ' . microtime(),
            'categories' => [1],
            'price' => 300
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
    public function testPutProductNonUniqueName(): void
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

        $this->put('/api/products', [
            'name' => $name,
            'categories' => [1],
            'price' => 300
        ], $headers);

        $response = $this->put('/api/products', [
            'name' => $name,
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
    public function testPutProductEmptyName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductEmptyCategories(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductEmptyPrice(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductNoParams(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductTooLongName(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductCategoriesNotArray(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductCategoryIsNaN(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductWrongCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
    public function testPutProductPriceIsNan(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->put('/api/products', [
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
