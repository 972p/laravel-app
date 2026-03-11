<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/campus', function(){
    return ('H3 Campus');
});

Route::get('/campus-map', function () {
    $adresse = "34 bis Rue du Cotentin, 75015 Paris";
    
    $url = "https://www.google.com/maps/search/?api=1&query=" . urlencode($adresse);

    return redirect()->away($url);
});

Route::get('/campus/{ville}', function ($ville) {
    return "Bienvenue à H3 Campus " . ucfirst($ville);
});