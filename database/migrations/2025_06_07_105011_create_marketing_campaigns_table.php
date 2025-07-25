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
        Schema::create('marketing_campaigns', function (Blueprint $table) {
        $table->id();
        $table->foreignId('seller_id')->constrained('users');
        $table->foreignId('book_id')->constrained();
        $table->string('fb_campaign_id');
        $table->string('name');
        $table->enum('status', ['active', 'paused', 'completed'])->default('active');
        $table->decimal('budget', 10, 2);
        $table->json('metrics')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_campaigns');
    }
};
