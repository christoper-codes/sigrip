<?php

use Carbon\Carbon;

function dateFormat(string $date): string
{
     return Carbon::parse($date)->translatedFormat('l, d \d\e F \d\e Y, H:i');
}
