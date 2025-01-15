<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::factory()->superadmin()->create();
        Permission::factory()->createPost()->create();
        Permission::factory()->editPost()->create();
        Permission::factory()->deletePost()->create();
        Permission::factory()->publishPost()->create();
    }
}
