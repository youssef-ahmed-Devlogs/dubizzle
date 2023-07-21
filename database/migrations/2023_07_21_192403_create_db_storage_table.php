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
        Schema::create('db_storage', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->enum('file_type',['jpg','jpeg','png','webp','pdf'])->nullable();
            $table->float('file_size')->default(0);
            $table->morphs('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_storage');
    }
};
