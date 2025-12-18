<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'alert_type_id',
        'company_id',
        'department_id',
        'application_id',
        'user_id',
        'name',
        'subject',
        'ai_response',
        'risk_level',
        'risk_score',
        'read_by_user',
        'read_by_department',
        'is_active',
    ];
}
