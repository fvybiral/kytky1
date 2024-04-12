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
            $paired = DB::table('kytka')->where('souborid', $soubor->id)
                ->whereExists(function (Builder $query) {
                    $query->select(DB::raw(1))
                        ->from('encyklopedie')
                        ->whereColumn('encyklopedie.id', 'kytka.encyklopedieid')
                        ->whereNotNull('name');
                })->count();
            $soubor->progress = $total > 0 ? round($paired / $total * 100, 2) : 0;
            $soubor->save();
        }

        return view('soubory', [
            'soubory' => $soubory,
        ]);
    }

    public function show($id)
    {
        $soubor = Soubor::find($id);
        $kytky = Kytka::with('encyklopedie')->where('souborid', $soubor->id)->paginate(10);

        return view('soubor', [
            'id' => $id,
            'soubor' => $soubor,
            'kytky' => $kytky,
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
}
