<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory()
            ->count(5)
            ->hasProducts(10)
            ->create();

        $testUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $testUser->profile()->save(\App\Models\Profile::factory()->make());

        $this->call(StudentCourseSeeder::class);

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->profile()->save(\App\Models\Profile::factory()->make());
        });
    }
}
