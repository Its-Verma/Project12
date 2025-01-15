<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
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
        ];
    }
    public function superadmin()
    {
        return $this->state([
            'name' => 'superadmin',
        ]);
    }
    public function editPost()
    {
        return $this->state([
            'name' => 'edit-post',
        ]);
    }
    public function createPost()
    {
        return $this->state([
            'name' => 'create-post',
        ]);
    }
    public function deletePost()
    {
        return $this->state([
            'name' => 'delete-post',
        ]);
    }
    public function publishPost()
    {
        return $this->state([
            'name' => 'publish-post',
        ]);
    }
}
