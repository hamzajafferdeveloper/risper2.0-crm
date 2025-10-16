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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('short_code')->nullable();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('has_end_date', ['yes', 'no'])->default('yes');
            $table->foreignId('category_id')->nullable()->constrained('project_categories');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('client_id')->nullable()->constrained('clients');
            $table->text('summary')->nullable();
            $table->text('note')->nullable();
            $table->enum('public_gantt_chart', ['yes', 'no'])->default('yes');
            $table->enum('public_task_board', ['yes', 'no'])->default('yes');
            $table->enum('task_need_approval', ['yes', 'no'])->default('yes');
            $table->string('file')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies');
            $table->decimal('budget')->nullable();
            $table->decimal('estimated_hours')->nullable();
            $table->integer('calculate_progress')->default(0)->comment('0 = None, 1 = Base on Task Completion, 2 = Base on project total time, 3 = Calculate progress through project dates');
            $table->enum('allow_manual_timelog', ['yes', 'no'])->default('no');
            $table->enum('enable_microboard', ['yes', 'no'])->default('no');
            $table->string('micro_board_id')->nullable();
            $table->enum('client_can_access_micro', ['yes', 'no'])->default('no');
            $table->enum('send_task_notification_to_client', ['yes', 'no'])->default('no');
            $table->integer('status')->default(0)->comment('0 = not start, 1 = in progress, 2 = on hold, 3 = cancelled, 4 = finished');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
