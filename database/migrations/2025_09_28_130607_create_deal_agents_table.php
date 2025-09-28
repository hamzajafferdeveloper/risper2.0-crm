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
        Schema::create('deal_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aggent')->constrained('employees')->onDelete('cascade');
            $table->foreignId('deal_category_id')->constrained('deal_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_agents');
    }
};
