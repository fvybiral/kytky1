<?php

namespace App\Livewire;

use App\Jobs\ZpracujSouborJob;
use App\Models\Kytka;
use App\Models\Nomenklatura;
use App\Models\Soubor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class UploadNomenklatura extends Component
{
    use WithFileUploads;

    public $soubor;

    public function render()
    {
        return view('livewire.upload-nomenklatura');
    }

    public function save()
    {
        $this->validate([
            'soubor' => 'required|max:102400|mimes:csv,txt', // 100MB Max
        ]);

        $file_path = $this->soubor->store('nomenklatura');

        $skipHeader = true;
        $rows = 0;
        $filename = storage_path('app/' . $file_path);
        if (($handle = fopen($filename, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                if ($skipHeader) {
                    $skipHeader = false;
                    continue;
                }
                if (!empty($data)) {
                    $nomenklatura = Nomenklatura::where('name', $data[0])->first();

                    if (!$nomenklatura) {
                        $rows++;
                        try {
                            $prepared = $data[0];
                            Nomenklatura::create([
                                'name' => $data[0],
                                'normalized_name' => collect(explode(' ', $prepared))
                                    ->map(function ($word) {
                                        if (in_array($word,['×','+','×','x'])) {
                                            return $word;
                                        }
                                        return trim(mb_strtolower(Str::ascii($word)));
                                    })
                                    ->filter(function ($word) {
                                        return $word !== '' && $word !== ' ' && $word !== null;
                                    })
//                        ->sort()
                                    ->join('-'),
                            ]);
                        }
                        catch (\Exception $e){
                            logger()->error('Nomenklatura: '.$data[0]);
                        }
                    }
                }
            }
            fclose($handle);
        }

        flash()->success('Importováno '.$rows.' nových záznamů');

        return $this->redirect('/nomenklatura');
    }
}
