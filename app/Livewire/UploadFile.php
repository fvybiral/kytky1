<?php

namespace App\Livewire;

use App\Jobs\ZpracujSouborJob;
use App\Models\Soubor;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $soubor;

    public function render()
    {
        return view('livewire.upload-file');
    }

    public function save()
    {
        $this->validate([
            'soubor' => 'required|max:102400|mimes:csv,txt', // 100MB Max
        ]);

        $soubor = Soubor::create([
            'name' => $this->soubor->getClientOriginalName(),
            'storage_path' => $this->soubor->store('soubory'),
            'state' => 'UPLOADED',
        ]);

        ZpracujSouborJob::dispatch($soubor);

        flash()->success('Soubor nahrán');

        return $this->redirect('/soubory');
    }
}
