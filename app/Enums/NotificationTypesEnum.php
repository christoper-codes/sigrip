<?php

declare(strict_types=1);

namespace App\Enums;

enum NotificationTypesEnum: string
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';
}
