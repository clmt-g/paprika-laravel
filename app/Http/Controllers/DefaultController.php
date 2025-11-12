<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index()
    {
        // Pour l'instant, on met des valeurs de test en dure
        $nbCasernes = 12;
        $nbPompiers = 45;

        return view('home', [
            'nbCasernes' => $nbCasernes,
            'nbPompiers' => $nbPompiers
        ]);
    }
}
