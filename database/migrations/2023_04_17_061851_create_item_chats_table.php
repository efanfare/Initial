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
        Schema::create('item_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scene_id')->nullable();
            $table->foreign('scene_id')->references('id')->on('scenes')->onDelete('cascade');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('uuid')->nullable();
            $table->string('title')->nullable();
            $table->enum('type', ['Text', 'Image'])->default('Text');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_chats');
    }
};
