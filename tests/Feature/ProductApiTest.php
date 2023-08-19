<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;


class ProductApiTest extends TestCase
{
    use RefreshDatabase; // Это использует транзакции для сброса состояния базы данных после каждого теста.

    /** @test */
    public function can_retrieve_all_products()
    {
        $products = Product::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    /** @test */
    public function can_create_a_product()
    {
        $productData = [
            'name' => 'Sample Product',
            'description' => 'A sample product for testing',
            'price' => 99.99,
        ];

        $response = $this->postJson('/api/v1/products', $productData);

        $response->assertStatus(201);
        $response->assertJsonFragment($productData);

        $this->assertDatabaseHas('products', $productData);
    }

    /** @test */
    public function can_retrieve_a_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/v1/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }

    /** @test */
    public function can_update_a_product()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product Name',
            'description' => 'Updated description',
            'price' => 199.99,
        ];

        $response = $this->putJson("/api/v1/products/{$product->id}", $updatedData);

        $response->assertStatus(200);
        $response->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('products', $updatedData);
    }

    /** @test */
    public function can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/v1/products/{$product->id}");

        $response->assertStatus(204); // No content

        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }
}
