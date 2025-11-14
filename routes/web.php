<?php

use App\Http\Controllers\PompierController;
use App\Models\Pompier;
use Illuminate\Support\Facades\Route;

// ============= Pompier get =============
Route::get('/', [\App\Http\Controllers\DefaultController::class, 'index'])->name('home');
Route::get('/pompiers', [PompierController::class, 'show'])->name('pompiers');
Route::get('/pompiers/detail/{id}', [PompierController::class, 'detail'])->name('pompiers.detail');
Route::get('/pompiers/create', [PompierController::class, 'create'])->name('pompiers.create');

// ============= Pompier post =============
Route::post('/pompiers/create', [PompierController::class, 'store'])
    ->name('pompiers.do_create');

// ============= Caserne get =============

// ============= Caserne post =============





// ============= Scratch file =============
Route::get('/scratch', function () {
    // ===== Afficher les nom et prenom 10 premiers pompiers
    //$pompiers = \App\Models\Pompier::take(10)->get();
    //foreach ($pompiers as $pompier) {
    //   echo $pompier->Nom . " " . $pompier->Prenom . '<br>';
    //}

    // ===== Changer le nom d'un pompier =====
    //$pompier = Pompier::find("P000004");
    //$pompier->Nom = 'Donald';
    //$pompier->update();
    //echo $pompier;

    // ===== delete un pompier =====
    //$pompier = Pompier::find("P000004");
    //$pompier->delete();

    // ===== get num caserne =====
    $pompier = Pompier::find("P000006");
    $caserne = $pompier->caserne->Ville;
    dd($caserne);
});
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
