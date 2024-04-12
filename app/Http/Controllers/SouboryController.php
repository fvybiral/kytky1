<?php

namespace App\Http\Controllers;

use App\Models\Kytka;
use App\Models\Soubor;
use DB;
use Illuminate\Database\Query\Builder;
use Storage;

class SouboryController extends Controller
{
    public function index()
    {
        $soubory = Soubor::get();

        foreach ($soubory as $soubor) {
            $total = DB::table('kytka')->where('souborid', $soubor->id)->count();
            $encyklopedie = DB::table('kytka')
                ->where('souborid', $soubor->id)
                ->whereNotNull('encyklopedieid')
                ->whereExists(function (Builder $query) {
                    $query->select(DB::raw(1))
                        ->from('encyklopedie')
                        ->whereColumn('encyklopedie.id', 'kytka.encyklopedieid')
                        ->whereNotNull('name');
                })
                ->count();
            $nomenklatura = DB::table('kytka')
                ->where('souborid', $soubor->id)
                ->whereNotNull('nomenklaturaid')
                ->count();
            $soubor->progress = $total > 0 ? round(($encyklopedie + $nomenklatura) / $total * 100, 2) : 0;
            if ($soubor->progress === 10) {
                $soubor->status = 'DONE';
            }
            $soubor->save();
        }

        return view('soubory', [
            'soubory' => $soubory,
        ]);
    }

    public function show($id)
    {
        $soubor = Soubor::find($id);
        $kytky = Kytka::where('souborid', $soubor->id)
            ->with('encyklopedie')
            ->with('nomenklatura')
            ->paginate(20);

        return view('soubor', [
            'id' => $id,
            'soubor' => $soubor,
            'kytky' => $kytky,
            'tab' => 'all'

        ]);
    }

    public function unpaired($id)
    {
        $soubor = Soubor::find($id);
        $kytky = Kytka::where('souborid', $soubor->id)
            ->with('encyklopedie')
            ->with('nomenklatura')
            ->whereNull('kytka.nomenklaturaid')
            ->whereExists(function ($subQuery) {
                $subQuery->select(DB::raw(1))
                    ->from('encyklopedie')
                    ->whereColumn('encyklopedie.id', 'kytka.encyklopedieid')
                    ->whereNull('encyklopedie.nomenklaturaid');
            })
            ->paginate(20);

        return view('soubor', [
            'id' => $id,
            'soubor' => $soubor,
            'kytky' => $kytky,
            'tab' => 'unpaired'
        ]);
    }

    public function destroy($id)
    {
        $soubor = Soubor::find($id);
        Storage::delete($soubor->storage_path);
        $soubor->delete();
        Kytka::where('souborid', $id)->delete();
        flash()->success('Soubor odstraněn');

        return redirect()->back();
    }

    public function download($id)
    {
        // Najdeme soubor podle ID
        $soubor = Soubor::find($id);
        if (!$soubor) {
            return response()->json(['error' => 'Soubor nenalezen'], 404);
        }

        // Získáme všechny kytky přiřazené k tomuto souboru
        $kytky = Kytka::with('encyklopedie')
            ->with('nomenklatura')
            ->where('souborid', $soubor->id)
            ->get();

        // Název pro výstupní CSV soubor
        $csvFileName = str_replace('.csv', '-' . date('Y-m-d H:i.s') . '.csv', $soubor->name);

        // Hlavičky pro CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ];

        // Vytvoření CSV souboru a zápis do response streamu
        $callback = function () use ($kytky) {
            $file = fopen('php://output', 'w');
            // Vypsání hlavičky souboru
            fputcsv($file, ['input', 'name', 'addition']);

            // Projdeme všechny kytky a zapisujeme je do souboru
            foreach ($kytky as $kytka) {
                fputcsv($file, [
                    $kytka->input,
                    optional($kytka->nomenklatura)->name ?? $kytka->encyklopedie->name,
                    $kytka->nomenklatura ? '' : optional($kytka->encyklopedie)->addition,
                ]);
            }
            fclose($file);
        };

        // Vrátíme CSV jako response s hlavičkami, které zajistí stažení souboru
        return response()->stream($callback, 200, $headers);
    }

    public function deduplicate($id)
    {
        // Najít duplicitní kytky
        $duplicitniKytky = DB::table('kytka')
            ->select('input')
            ->where('souborid', $id)
            ->groupBy('input')
            ->havingRaw('count(input) > 1')
            ->get()
            ->pluck('input');

        // Projít každou encyklopedieid a smazat všechny duplicitní záznamy kromě jednoho
        foreach ($duplicitniKytky as $input) {
            // Získat všechny kytky s danou encyklopedieid, kromě jednoho (nejstaršího nebo nejnovějšího podle preference)
            $kytkyKeSmazani = DB::table('kytka')
                ->where('souborid', $id)
                ->where('input', $input)
                ->orderBy('id') // Nebo orderByDesc('id') pokud chcete ponechat nejnovější
                ->skip(1) // Ponecháme první záznam a ostatní smažeme
                ->take(PHP_INT_MAX) // Vezme všechny zbylé záznamy
                ->get()
                ->pluck('id');

            // Smazat vybrané kytky
            if ($kytkyKeSmazani->isNotEmpty()) {
                DB::table('kytka')->whereIn('id', $kytkyKeSmazani)->delete();
            }
        }

        flash()->success('Byly odstraněny ' . count($duplicitniKytky) . ' duplicity');

        return back();
    }
}
