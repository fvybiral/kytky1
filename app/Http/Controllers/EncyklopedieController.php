<?php

namespace App\Http\Controllers;

use App\Models\Encyklopedie;

class EncyklopedieController extends Controller
{
    public function index()
    {
        return view('encyklopedie', [
            'tab' => 'all',
            'encyklopedie' => Encyklopedie::orderBy('input')->paginate(50),
        ]);
    }

    public function unpaired()
    {
        return view('encyklopedie', [
            'tab' => 'unpaired',
            'encyklopedie' => Encyklopedie::orderBy('input')->whereNull('name')->paginate(50),
        ]);
    }
}
