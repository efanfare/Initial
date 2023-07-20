<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_name');
            $table->float('price_monthly', 15, 2);
            $table->float('price_yearly', 15, 2);
            $table->string('options')->nullable();
            $table->string('status')->nullable();
            $table->float('yearly_discount', 15, 2);
            $table->string('stripe_plan_monthly')->nullable();
            $table->string('stripe_plan_yearly')->nullable();
            $table->integer('scene_limit_monthly')->nullable();
            $table->string('item_limit_monthly')->nullable();
            $table->integer('scene_limit_yearly')->nullable();
            $table->string('item_limit_yearly')->nullable();
            $table->boolean('google_ads_free')->default(0)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
}
