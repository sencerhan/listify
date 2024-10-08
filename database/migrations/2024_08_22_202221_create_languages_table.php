<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->string("flag");
            $table->boolean("default")->default(false);
            $table->boolean("is_deleted")->default(false);
            $table->timestamps();
        });
        DB::table('languages')->insert([
            'name' => 'Turkish',
            'code' => 'tr',
            'flag' => 'img/Flag_of_Turkey.webp',
            'default' => true,
            'is_deleted' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
