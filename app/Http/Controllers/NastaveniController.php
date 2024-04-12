<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NastaveniController extends Controller
{
    public function index()
    {
        return view('nastaveni');
    }
}
