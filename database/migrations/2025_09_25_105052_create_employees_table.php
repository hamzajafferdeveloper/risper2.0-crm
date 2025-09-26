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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->enum('salutation', ['Mr', 'Mrs', 'Miss', 'Dr.', 'Sir', 'Madam'])->default('Mr');
            $table->string('name');
            $table->string('email');
            $table->string('profile_pic')->nullable();
            $table->string('password');
            $table->foreignId('designation_id')->nullable()->constrained('employee_designations');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('mobile')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->date('joining_date');
            $table->date('date_of_birth')->nullable();
            $table->foreignId('reporting_to')->nullable()->constrained('employees');
            $table->foreignId('language_id')->nullable()->constrained('languages');
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->enum('login_allowed', ['yes', 'no'])->default('yes');
            $table->enum('receive_email_notification', ['yes', 'no'])->default('yes');
            $table->string('slack_member_id')->nullable();
            $table->json('skills')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->date('notice_period_start_date')->nullable();
            $table->date('notice_period_end_date')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies');
            $table->decimal('hourly_date')->nullable();
            $table->foreignId('employee_type_id')->nullable()->constrained('employment_types');
            $table->enum('marital_status', ['Single', 'Married', 'Widower', 'Widow', 'Separate', 'Divorced', 'Engaged'])->default('Single');
            $table->foreignId('business_address_id')->nullable()->constrained('business_addresses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
