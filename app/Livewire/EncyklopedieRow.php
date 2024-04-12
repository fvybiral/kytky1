<?php

namespace App\Livewire;

use App\Models\Nomenklatura;
use Livewire\Component;

class EncyklopedieRow extends Component
{
    public $zaznam;

    public $query;

    public $addition;

    public $selected = null;

    public function mount()
    {
        $this->query = $this->zaznam->input;
    }

    public function select($id)
    {
        $this->selected = $id;
    }

    public function save()
    {
        $this->zaznam->name = Nomenklatura::find($this->selected)->name;
        $this->zaznam->addition = $this->addition;
        $this->zaznam->save();
    }

    public function cancel()
    {
        $this->zaznam->name = 'XXX';
        $this->zaznam->save();
    }

    public function render()
    {
        $searchBlocked = strlen($this->query) < 3 || $this->zaznam->input == $this->query;

        return view('livewire.encyklopedie-row',[
            'result' => $searchBlocked ? null : Nomenklatura::where('name','like','%'.$this->query.'%')->get(),
        ]);
    }
}
