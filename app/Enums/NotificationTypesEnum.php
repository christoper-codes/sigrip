<?php

namespace App\Enums;

enum NotificationTypesEnum: string
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';
}
