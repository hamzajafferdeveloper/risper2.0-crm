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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->enum('salutation', ['Mr', 'Mrs', 'Miss', 'Dr.', 'Sir', 'Madam'])->default('Mr');
            $table->string('name');
            $table->string('email');
            $table->foreignId('lead_source_id')->nullable()->constrained('lead_sources');
            $table->foreignId('added_by')->nullable()->constrained('employees');
            $table->foreignId('lead_owner')->nullable()->constrained('employees');
            $table->enum('auto_convert_lead_to_client', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
