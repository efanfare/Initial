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
        Schema::create('scene_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('scene_id');
            $table->foreign('scene_id')->references('id')->on('scenes')->onDelete('cascade');
            $table->string('email');
            $table->string('token', 16)->unique();
            $table->text('invitation_message')->nullable();
            $table->boolean('is_accepted')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scene_invitations');
    }
};
