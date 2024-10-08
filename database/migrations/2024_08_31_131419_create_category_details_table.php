<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     /*
     categories['langauge_id']
     */
    public function up(): void
    {
        Schema::create('category_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('meta_title')->nullable(true);
            $table->string('meta_description')->nullable(true);
            $table->string('meta_keywords')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->string('slug');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('category_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_details');
    }
};
