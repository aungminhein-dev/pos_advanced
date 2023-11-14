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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->longText('description');
            $table->enum('arrival_status', ['New', 'Old'])->default('New');
            $table->integer('price');
            $table->integer('rating')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
