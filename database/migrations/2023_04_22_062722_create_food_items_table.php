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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('measure');
            $table->float('calories');
            $table->float('protein');
            $table->float('fat');
            $table->float('carbs');
            $table->float('fibre');
            $table->unsignedBigInteger('food_category_id');
            $table->foreign('food_category_id')->references('id')->on('food_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_items', function (Blueprint $table) {
            $table->dropForeign('food_items_food_category_id_foreign');
        });

        Schema::dropIfExists('food_items');
    }
};
