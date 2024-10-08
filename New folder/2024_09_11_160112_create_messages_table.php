<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id')->index();
            $table->integer('receiver_id')->index();
            $table->longText('message');
            $table->boolean('is_reached')->default(false);
            $table->boolean('is_seen')->default(false);
            $table->string('file_path')->nullable();
            $table->integer('deletedBySender')->default(0);
            $table->integer('deletedByReceiver')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
