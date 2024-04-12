<?php

namespace App\Http\Controllers;

use App\Models\Nomenklatura;

class NomenklaturaController extends Controller
{
    public function index()
    {
        return view('nomenklatura', [
            'nomenklatura' => Nomenklatura::get()
        ]);
    }
}
