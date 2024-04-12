<?php

namespace App\Livewire;

use App\Models\Nomenklatura;
use Livewire\Component;

class EncyklopedieRow extends Component
{
    public $zaznam;

    public $query;
    public $initial;

    public $addition;

    public $selected = null;

    public function mount()
    {
        $this->initial = $this->zaznam->input;
        $this->query = $this->zaznam->input;
    }

    public function select($id)
    {
        $this->selected = $id;
        if ($id) {
            $this->query = Nomenklatura::find($id)->name;
        }
        else {
            $this->query = $this->initial;
        }
    }

    public function fix()
    {
        $this->selected = null;
        $this->query = $this->initial;
        $this->addition = null;
        $this->zaznam->nomenklaturaid = null;
        $this->zaznam->name = null;
        $this->zaznam->addition = null;
        $this->zaznam->save();
    }

    public function save()
    {
        $this->zaznam->nomenklaturaid = $this->selected;
        $this->zaznam->name = Nomenklatura::find($this->selected)->name;
        $this->zaznam->addition = $this->addition;
        $this->zaznam->save();
    }

    public function cancel()
    {
        $this->query = 'XXX';
        $this->zaznam->name = 'XXX';
        $this->zaznam->save();
    }

    public function render()
    {
        $searchBlocked = strlen($this->query) < 3 || $this->zaznam->input == $this->query;

        return view('livewire.encyklopedie-row',[
            'result' => $searchBlocked ? null : Nomenklatura::where('name','like','%'.trim($this->query).'%')->get(),
        ]);
    }
}
