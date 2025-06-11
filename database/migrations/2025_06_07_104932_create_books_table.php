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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('category_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('cover_image');
            $table->string('file_path');
            $table->integer('download_count')->default(0);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
