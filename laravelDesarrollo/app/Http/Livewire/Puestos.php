<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Puesto;

class Puestos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $id_puesto, $puesto;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.puestos.view', [
            'puestos' => Puesto::first()
						->orWhere('puesto', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->id_puesto = null;
		$this->puesto = null;
    }

    public function store()
    {
        $this->validate([
		'id_puesto' => 'required',
        ]);

        Puesto::create([ 
			'puesto' => $this-> puesto
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Puesto Successfully created.');
    }

    public function edit($id)
    {
        $record = Puesto::findOrFail($id);

        $this->selected_id = $id; 
		$this->id_puesto = $record-> id_puesto;
		$this->puesto = $record-> puesto;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'id_puesto' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Puesto::find($this->selected_id);
            $record->update([ 
			'id_puesto' => $this-> id_puesto,
			'puesto' => $this-> puesto
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Puesto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Puesto::where('id_puesto', $id);
            $record->delete();
        }
    }
}
