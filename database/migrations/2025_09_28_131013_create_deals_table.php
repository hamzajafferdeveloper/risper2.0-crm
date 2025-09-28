<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->string('name');
            $table->foreignId('pipe_line_id')->constrained('lead_piplines')->cascadeOnDelete();
            $table->foreignId('deal_stage_id')->constrained('deal_stages')->cascadeOnDelete();
            $table->foreignId('currency_id')->constrained('currencies')->cascadeOnDelete();
            $table->decimal('deal_value');
            $table->date('close_date');
            $table->foreignId('deal_category_id')->constrained('deal_categories')->cascadeOnDelete();
            $table->foreignId('deal_agent_id')->constrained('deal_agents')->cascadeOnDelete();
            $table->foreignId('deal_watcher_id')->constrained('employees')->cascadeOnDelete();
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
