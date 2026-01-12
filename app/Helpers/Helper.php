<?php

use Carbon\Carbon;

function dateFormat(string $date): string
{
     $carbon = Carbon::parse($date);
     $carbon->locale('es');

     return $carbon->translatedFormat('l, d \d\e F \d\e Y, H:i');
}
