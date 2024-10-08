<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        /*
                    $table->string("name");
            $table->string("code");
            $table->string("flag");
            $table->boolean("default")->default(false);
            $table->boolean("is_deleted")->default(false);*/


    }
}
