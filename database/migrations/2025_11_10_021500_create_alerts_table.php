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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_type_id')->constrained('alert_types');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('application_id')->nullable()->constrained('applications');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->text('subject')->nullable();
            $table->json('ai_response')->nullable();
            $table->string('risk_level')->nullable();
            $table->decimal('risk_score', 5, 2)->nullable();
            $table->boolean('read_by_user')->default(false);
            $table->boolean('read_by_department')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
