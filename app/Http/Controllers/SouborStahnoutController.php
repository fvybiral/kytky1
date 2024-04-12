<?php

namespace App\Http\Controllers;

use App\Models\Kytka;
use App\Models\Soubor;

class SouborStahnoutController extends Controller
{
    public function __invoke($id)
    {
        // Najdeme soubor podle ID
        $soubor = Soubor::find($id);
        if (!$soubor) {
            return response()->json(['error' => 'Soubor nenalezen'], 404);
        }

        // Získáme všechny kytky přiřazené k tomuto souboru
        $kytky = Kytka::with('encyklopedie')->where('souborid', $soubor->id)->get();

        // Název pro výstupní CSV soubor
        $csvFileName = 'kytky.csv';

        // Hlavičky pro CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ];

        // Vytvoření CSV souboru a zápis do response streamu
        $callback = function() use ($kytky) {
            $file = fopen('php://output', 'w');
            // Vypsání hlavičky souboru
            fputcsv($file, ['input', 'name', 'addition']);

            // Projdeme všechny kytky a zapisujeme je do souboru
            foreach ($kytky as $kytka) {
                fputcsv($file, [$kytka->input, $kytka->name ?? $kytka->encyklopedie->name, $kytka->addition??$kytka->encyklopedie->addition]);
            }
            fclose($file);
        };

        // Vrátíme CSV jako response s hlavičkami, které zajistí stažení souboru
        return response()->stream($callback, 200, $headers);
    }
}
