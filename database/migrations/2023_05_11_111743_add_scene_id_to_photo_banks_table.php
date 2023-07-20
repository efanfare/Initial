<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('photo_banks', function (Blueprint $table) {
            $table->unsignedBigInteger('scene_id')->nullable();
            $table->foreign('scene_id')->references('id')->on('scenes')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_banks', function (Blueprint $table) {
            //
        });
    }
};
