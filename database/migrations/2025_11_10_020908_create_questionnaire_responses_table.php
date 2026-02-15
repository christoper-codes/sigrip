<?php

declare(strict_types=1);

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
        Schema::create('questionnaire_responses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('application_id')->constrained('applications');
            $table->foreignId('questionnaire_id')->constrained('questionnaires');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('department_id')->constrained('departments');
            $table->json('employee_data')->nullable();
            $table->json('response_data');
            $table->json('ai_response')->nullable();
            $table->decimal('average_score', 5, 2)->nullable();
            $table->string('risk_level')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_responses');
    }
};
