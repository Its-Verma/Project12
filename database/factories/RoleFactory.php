<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->unique()->word, 
        ];
    }
    public function superAdmin()
    {
        return $this->state([
            'name' => 'Superadmin',
        ]);
    }
    public function editor()
    {
        return $this->state([
            'name' => 'Editor',
        ]);
    }
    public function publisher()
    {
        return $this->state([
            'name' => 'Publisher',
        ]);
    }
}