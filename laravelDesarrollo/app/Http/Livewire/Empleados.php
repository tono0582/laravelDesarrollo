<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empleado;
use App\Models\Puesto;

class Empleados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $id_empleado, $codigo, $nombres, $apellidos, $direccion, $telefono, $fecha_nacimiento, $id_puesto;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empleados.view', [
            'empleados' => Empleado::first()
						->orWhere('id_empleado', 'LIKE', $keyWord)
						->orWhere('codigo', 'LIKE', $keyWord)
						->orWhere('nombres', 'LIKE', $keyWord)
						->orWhere('apellidos', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('fecha_nacimiento', 'LIKE', $keyWord)
						->orWhere('id_puesto', 'LIKE', $keyWord)
						->paginate(10),
            'puestos' => Puesto::all()
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->id_empleado = null;
		$this->codigo = null;
		$this->nombres = null;
		$this->apellidos = null;
		$this->direccion = null;
		$this->telefono = null;
		$this->fecha_nacimiento = null;
		$this->id_puesto = null;
    }

    public function store()
    {

        Empleado::create([ 
			'codigo' => $this-> codigo,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono,
			'fecha_nacimiento' => $this-> fecha_nacimiento,
			'id_puesto' => $this-> id_puesto
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empleado Successfully created.');
    }

    public function edit($id)
    {
        $record = Empleado::findOrFail($id);

        $this->selected_id = $id; 
		$this->id_empleado = $record-> id_empleado;
		$this->codigo = $record-> codigo;
		$this->nombres = $record-> nombres;
		$this->apellidos = $record-> apellidos;
		$this->direccion = $record-> direccion;
		$this->telefono = $record-> telefono;
		$this->fecha_nacimiento = $record-> fecha_nacimiento;
		$this->id_puesto = $record-> id_puesto;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'id_empleado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Empleado::find($this->selected_id);
            $record->update([ 
			'id_empleado' => $this-> id_empleado,
			'codigo' => $this-> codigo,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono,
			'fecha_nacimiento' => $this-> fecha_nacimiento,
			'id_puesto' => $this-> id_puesto
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Empleado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Empleado::where('id_empleado', $id);
            $record->delete();
        }
    }
}
