<?php

namespace App\Livewire;

use App\Jobs\SparujSouborSEncyklopediiJob;
use App\Models\Soubor;
use Livewire\Component;

class SparujSoubor extends Component
{
    /**
     * @var Soubor
     */
    public $soubor;

    public function render()
    {
        return view('livewire.sparuj-soubor');
    }

    public function run()
    {
        SparujSouborSEncyklopediiJob::dispatch($this->soubor);
    }
}
