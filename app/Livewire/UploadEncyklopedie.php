<?php

namespace App\Livewire;

use App\Models\Encyklopedie;
use App\Models\Nomenklatura;
use Livewire\Component;
use Livewire\WithFileUploads;
use \Str;

class UploadEncyklopedie extends Component
{
    use WithFileUploads;

    public $soubor;

    public function render()
    {
        return view('livewire.upload-encyklopedie');
    }

    public function save()
    {
        $this->validate([
            'soubor' => 'required|max:102400|mimes:csv,txt', // 100MB Max
        ]);

        $file_path = $this->soubor->store('encyklopedie');

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
                    $encyklopedie = Encyklopedie::where('input', $data[0])->first();

                    if (!$encyklopedie) {
                        try {
                            $rows++;
                            $prepared = trim($data[0]);
                            $encyklopedie = Encyklopedie::create([
                                'input' => $prepared,
                                'normalized_input' => collect(explode(' ', $prepared))
                                    ->map(function ($word) {
                                        if (in_array($word,['×','+','×','x'])) {
                                            return $word;
                                        }
                                        return trim(mb_strtolower(preg_replace('#\s+#',' ', $word)));
                                    })
                                    ->filter(function ($word) {
                                        return $word !== '' && $word !== ' ' && $word !== null;
                                    })
                                    ->join(' '),
                                'name' => empty($data[1]) ? null : $data[1],
                                'addition' => empty($data[2]) ? null : $data[2],
                            ]);
                        }
                        catch (\Exception $e){
                            logger()->error($e);
                        }
                    }
                    else {
                        $encyklopedie->name = empty($data[1]) ? null : $data[1];
                        $encyklopedie->addition = empty($data[2]) ? null : $data[2];
                        $encyklopedie->save();
                    }

                    $nomenklatura = Nomenklatura::where('normalized_name', $encyklopedie->normalized_input)->first();

                    if ($nomenklatura) {
                        $encyklopedie->name = $nomenklatura->name;
                        $encyklopedie->save();
                    }
                }
            }
            fclose($handle);
        }

        flash()->success('Importováno '.$rows.' nových záznamů');

        return $this->redirect('/encyklopedie');
    }
}
