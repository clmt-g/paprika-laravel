<?php

use App\Http\Controllers\PompierController;
use App\Models\Caserne;
use App\Models\Pompier;
use Illuminate\Support\Facades\Route;

// ============= Pompier get =============
Route::get('/', [\App\Http\Controllers\DefaultController::class, 'index'])->name('home');
Route::get('/pompiers', [PompierController::class, 'show'])->name('pompiers');
Route::get('/pompiers/detail/{id}', [PompierController::class, 'detail'])->name('pompiers.detail');
Route::get('/pompiers/create', [PompierController::class, 'create'])->name('pompiers.create');
Route::get('/pompiers/update/{id}', [PompierController::class, 'update'])->name('pompiers.update');

// ============= Pompier post =============
Route::post('/pompiers/create', [PompierController::class, 'do_create'])->name('pompiers.do_create');
Route::post('/pompiers/do_update/{id}', [PompierController::class, 'do_update'])->name('pompiers.do_update');

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
    //$pompier = Pompier::find("P000006");
    //$caserne = $pompier->caserne->Ville;
    //dd($caserne);

    // ===== récupérer le dernier pompier =====
    //$pompier = Pompier::orderBy('Matricule', 'desc')->first();
    //dd($pompier);

    // ===== le nb de pompiers dans une caserne =====
    $caserne = Caserne::find(5);
    dd(count($caserne->pompiers));
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
