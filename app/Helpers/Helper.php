<?php

use Carbon\Carbon;

function dateFormat(string $date): string
{
     $carbon = Carbon::createFromFormat('d/m/Y H:i', $date);
     $carbon->locale('es');

     return $carbon->translatedFormat('l, d \d\e F \d\e Y, H:i');
}
