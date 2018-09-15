<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    /**
     *
     */
    public function testDeleteCategoryAsGuest(): void
    {
       $response = $this->delete('/api/categories/1');

        $response->assertStatus(401) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testDeleteCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $category = Category::create([
            'name' => 'Test 12345'
        ]);

        $response = $this->delete('/api/categories/' . $category->id, [], $headers);

        $response->assertStatus(200) &&
        $response->assertJsonStructure([
            'status',
        ]);
    }

    /**
     *
     */
    public function testDeleteNotEmptyCategory(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->delete('/api/categories/1', [], $headers);

        $response->assertStatus(500) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     *
     */
    public function testDeleteCategoryWrongId(): void
    {
        $response =  $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => '12345'
        ])->content();

        $loginResponse = json_decode($response);

        $headers = [
            'Authorization' => 'Bearer ' . $loginResponse->accessToken
        ];

        $response = $this->delete('/api/categories/10000', [], $headers);

        $response->assertStatus(404) &&
        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
