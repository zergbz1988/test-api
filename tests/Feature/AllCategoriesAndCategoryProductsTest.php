<?php

namespace Tests\Feature;

use Tests\TestCase;

class AllCategoriesAndCategoryProductsTest extends TestCase
{
    /**
     *
     */
    public function testAllCategoriesRequest(): void
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200) && $response->assertJsonStructure([
            'status',
            'categories' => [
                ['id', 'name', 'created_at', 'updated_at']
            ]
        ]);
    }

    /**
     *
     */
    public function testCategoryProductsRequest(): void
    {
        $response = $this->get('/api/categories/1/products');
        $response->assertStatus(200) && $response->assertJsonStructure([
            'status',
            'id',
            'products' => [
                ['id', 'name', 'price', 'created_at', 'updated_at']
            ]
        ]);
    }

    /**
     *
     */
    public function testCategoryProductsWrongIdRequest(): void
    {
        $response = $this->get('/api/categories/1000/products');

        $response->assertStatus(404) &&
        $response->assertJsonStructure([
            'status',
            'message'
        ]);
    }
}
