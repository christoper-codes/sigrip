<?php

use Carbon\Carbon;

function dateFormat(string $date): string
{
     return Carbon::createFromFormat('d/m/Y H:i', $date)
            ->translatedFormat('l, d \d\e F \d\e Y, H:i');
}
