<?php

namespace Database\Factories;

use App\Models\License;
use App\Models\Mod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

class ModFactory extends Factory
{
    protected $model = Mod::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        $name = fake()->catchPhrase();

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'teaser' => fake()->sentence(),
            'description' => fake()->paragraphs(random_int(4, 20), true),
            'license_id' => License::factory(),
            'source_code_link' => fake()->url(),
            'featured' => fake()->boolean(),
            'contains_ai_content' => fake()->boolean(),
            'contains_ads' => fake()->boolean(),
            'disabled' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the mod should be soft-deleted.
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => now(),
        ]);
    }
}
