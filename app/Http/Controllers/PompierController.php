<?php

namespace App\Http\Controllers;

use App\Models\Caserne;
use App\Models\Grade;
use App\Models\Pompier;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class PompierController extends Controller
{
    public function show() {
        $compteur = 1;
        $pompiers = Pompier::all();
        return view('pompier.show', ['pompiers' => $pompiers, 'compteur' => $compteur]);
    }

    public function detail($id) {
        $pompier = Pompier::find($id);
        return view('pompier.detail', ['pompier' => $pompier]);
    }

    // FIXME : CSRF Token ?
    public function create() {
        $pompiers = Pompier::all();
        $grades = Grade::all();
        $casernes = Caserne::all();
        return view('pompier.create', ['casernes' => $casernes, 'grades' => $grades, 'pompiers' => $pompiers]);
    }

    public function do_create() {

    }
}
