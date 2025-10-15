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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('salutation', ['Mr', 'Mrs', 'Miss', 'Dr.', 'Sir', 'Madam'])->default('Mr');
            $table->string('name');
            $table->string('email');
            $table->string('profile_pic')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('category_id')->nullable()->constrained('client_categories');
            $table->foreignId('sub_category_id')->nullable()->constrained('client_categories');
            $table->string('mobile')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->foreignId('language_id')->nullable()->constrained('languages');
            $table->enum('login_allowed', ['yes', 'no'])->default('yes');
            $table->enum('receive_email_notification', ['yes', 'no'])->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
