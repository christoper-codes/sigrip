<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->uuid('tracking_uuid')->nullable()->unique()->after('id');
            $table->string('contact_email')->nullable()->after('description');
            $table->string('contact_name')->nullable()->after('contact_email');
        });
    }

    public function down(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->dropColumn(['tracking_uuid', 'contact_email', 'contact_name']);
        });
    }
};
