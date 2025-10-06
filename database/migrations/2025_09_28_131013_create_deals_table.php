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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->foreignId('pipe_line_id')->nullable()->constrained('lead_piplines');
            $table->foreignId('deal_stage_id')->nullable()->constrained('deal_stages');
            $table->foreignId('currency_id')->nullable()->constrained('currencies');
            $table->decimal('deal_value')->nullable();
            $table->date('close_date')->nullable();
            $table->foreignId('deal_category_id')->nullable()->constrained('deal_categories');
            $table->foreignId('deal_agent_id')->nullable()->constrained('deal_agents');
            $table->foreignId('deal_watcher_id')->nullable()->constrained('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
