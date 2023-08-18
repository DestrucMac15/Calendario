<?php 
use Carbon\Carbon;

function setDate(){

    $date = Carbon::now()->settings([
        'locale' => 'es_MX',
        'timezone' => 'America/Mexico_City',
    ]);

    return $date;

}