<?php

namespace App\Http\Controllers;

use App\Models\Kytka;
use DB;

class SouborDuplicityController extends Controller
{
    public function __invoke($id)
    {
        // Najít duplicitní kytky
        $duplicitniKytky = DB::table('kytka')
            ->select('encyklopedieid')
            ->where('souborid', $id)
            ->groupBy('encyklopedieid')
            ->havingRaw('count(encyklopedieid) > 1')
            ->get()
            ->pluck('encyklopedieid');

        // Projít každou encyklopedieid a smazat všechny duplicitní záznamy kromě jednoho
        foreach ($duplicitniKytky as $encyklopedieid) {
            // Získat všechny kytky s danou encyklopedieid, kromě jednoho (nejstaršího nebo nejnovějšího podle preference)
            $kytkyKeSmazani = DB::table('kytka')
                ->where('souborid', $id)
                ->where('encyklopedieid', $encyklopedieid)
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

        flash()->success('Byly odstraněny '.count($duplicitniKytky). ' duplicity');

        return back();
    }
}
