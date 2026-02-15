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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracking_uuid')->nullable()->unique();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('incident_type_id')->constrained('incident_types');
            $table->foreignId('support_ticket_status_id')->constrained('support_ticket_statuses');
            $table->foreignId('alert_id')->nullable()->constrained('alerts');
            $table->string('alert_uuid')->nullable();
            $table->foreign('alert_uuid')->references('uuid')->on('alerts');
            $table->foreignId('created_by_user_id')->nullable()->constrained('users');
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_priority')->default(true);
            $table->boolean('created_by_ai')->default(false);
            $table->boolean('is_active')->default(true);
            $table->date('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
