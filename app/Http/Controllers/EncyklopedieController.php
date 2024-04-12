<?php

namespace App\Http\Controllers;

use App\Models\Encyklopedie;
use DB;

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
            'encyklopedie' => Encyklopedie::orderBy('input')->whereNull('nomenklaturaid')->paginate(50),
        ]);
    }

    public function download()
    {
        // Získáme všechny kytky přiřazené k tomuto souboru
        $zaznamy = Encyklopedie::whereNotNull('name')->where('name', '<>', DB::raw('input'))->get();

        // Název pro výstupní CSV soubor
        $csvFileName = 'slovnik.csv';

        // Hlavičky pro CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ];

        // Vytvoření CSV souboru a zápis do response streamu
        $callback = function() use ($zaznamy) {
            $file = fopen('php://output', 'w');
            // Vypsání hlavičky souboru
            fputcsv($file, ['input', 'name', 'addition']);

            // Projdeme všechny kytky a zapisujeme je do souboru
            foreach ($zaznamy as $zaznam) {
                fputcsv($file, [$zaznam->input, $zaznam->name, $zaznam->addition]);
            }
            fclose($file);
        };

        // Vrátíme CSV jako response s hlavičkami, které zajistí stažení souboru
        return response()->stream($callback, 200, $headers);
    }
}
