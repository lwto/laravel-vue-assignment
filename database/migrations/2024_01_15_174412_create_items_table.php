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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->string('category');
            $table->string('price');
            $table->string('description');
            $table->string('condition');
            $table->string('type');
            $table->string('status');
            $table->string('photo');
            $table->string('owner_name');
            $table->string('contact');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
