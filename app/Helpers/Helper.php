<?php

use Carbon\Carbon;

function dateFormat(string $date): string
{
     $formats = [
          'd/m/Y H:i',
          'd/m/Y',
          'Y-m-d H:i:s',
          'Y-m-d H:i',
          'Y-m-d',
     ];
     $carbon = null;
     foreach ($formats as $format) {
          try {
               $carbon = Carbon::createFromFormat($format, $date);
               break;
          } catch (Exception $e) {
                continue;
          }
     }
     if (!$carbon) {
          try {
               $carbon = Carbon::parse($date);
          } catch (Exception $e) {
               return $date;
          }
     }

     $carbon->locale('es');
     return $carbon->translatedFormat('l, d \d\e F \d\e Y, H:i');
}
