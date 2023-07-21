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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users','id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->nullable()->constrained('categories','id')->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->text('description');
            $table->string('cover');
            $table->bigInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
