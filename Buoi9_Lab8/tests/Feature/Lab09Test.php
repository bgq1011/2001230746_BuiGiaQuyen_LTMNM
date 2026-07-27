<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\Course;

class Lab09Test extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_exercise_05_one_to_one_user_profile()
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $profile = Profile::create([
            'user_id' => $user->id,
            'address' => '123 Main St',
            'phone' => '0987654321',
        ]);

        $this->assertEquals($profile->id, $user->profile->id);
        $this->assertEquals('John Doe', $profile->user->name);

        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('0987654321');
    }

    /** @test */
    public function test_exercise_06_and_07_products_crud_and_stock()
    {
        $category = Category::factory()->create(['name' => 'Electronics']);

        // Create Product
        $response = $this->post('/products', [
            'name' => 'Laptop Gaming',
            'price' => 15000000,
            'stock' => 25,
            'category_id' => $category->id,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Laptop Gaming',
            'price' => 15000000,
            'stock' => 25,
            'category_id' => $category->id,
        ]);

        $product = Product::where('name', 'Laptop Gaming')->first();

        // Edit & Update Product
        $response = $this->get("/products/{$product->id}/edit");
        $response->assertStatus(200);

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Laptop Gaming Pro',
            'price' => 18000000,
            'stock' => 30,
            'category_id' => $category->id,
        ]);
        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Laptop Gaming Pro',
            'stock' => 30,
        ]);

        // Delete Product
        $response = $this->delete("/products/{$product->id}");
        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function test_exercise_08_advanced_eloquent_queries()
    {
        $category = Category::factory()->create(['name' => 'Smartphones']);
        Product::factory()->create([
            'name' => 'High End Phone',
            'price' => 250000,
            'category_id' => $category->id,
        ]);

        $student = Student::factory()->create(['name' => 'Alice']);
        $course = Course::factory()->create(['title' => 'Laravel Advanced']);
        $student->courses()->attach($course->id);

        $response = $this->get('/advanced');
        $response->assertStatus(200);
        $response->assertSee('High End Phone');
        $response->assertSee('Smartphones');
        $response->assertSee('Alice');
    }
}
