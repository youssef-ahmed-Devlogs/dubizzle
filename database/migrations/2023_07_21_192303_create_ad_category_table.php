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
        Schema::create('ad_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ad_id')->constrained('ads','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_category');
    }
};
