<?php

use Illuminate\Support\Facades\Route;

Route::get('/name/{nom}', function ($nom, Request $r) {

    /*
    $name = "clement";
    Debugbar::info($name);
    Debugbar::warning('This is an info message');
    Debugbar::error('This is an error message');
    DebugBar::addMessage('This is an info message');
    */

    return "votre nom est : " . $nom;
    //return view('welcome');
})->where('nom', '[A-Za-z]+')
    ->name('profile');

Route::get('/', [\App\Http\Controllers\DefaultController::class, 'index'])->name('home');
