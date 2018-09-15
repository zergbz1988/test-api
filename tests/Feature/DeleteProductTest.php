<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /**
     *
     */
    public function testDeleteProductAsGuest(): void
    {
        $response = $this->delete('/api/products/1');

        $response->assertStatus(401) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testDeleteProduct(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $product = Product::create([
            'name' => 'Test 12345',
            'price' => 12454
        ]);

        $response = $this->delete('/api/products/' . $product->id, [], $headers);

        $response->assertStatus(200) &&
        $response->assertJsonStructure([
            'status',
        ]);
    }

    /**
     *
     */
    public function testDeleteProductWrongId(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->delete('/api/products/10000', [], $headers);

        $response->assertStatus(404) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
