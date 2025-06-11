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
        Schema::create('seller_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->unique();
        $table->string('store_name');
        $table->text('bio')->nullable();
        $table->string('facebook_page')->nullable();
        $table->string('website')->nullable();
        $table->string('bank_account')->nullable();
        $table->string('tax_id')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};
