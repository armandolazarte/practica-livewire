<?php

namespace App\Http\Livewire;

use App\empresa;
use Livewire\Component;
use Livewire\WithPagination;

class EmpresaController extends Component
{
    use WithPagination;

    public $nombre, $direccion, $localidad, $telefono, $email, $pageTitle, $componentName;
    public $pagination = 5, $search, $selected_id, $record;
    public $updateMode = false;

    protected $listeners = [
        'deletereg'   => 'Destroy'
    ];

    public function mount()
    {
        $this->pageTitle = "Sucursales de la";
        $this->componentName = "Empresa";
    }

    // funcion resetear campos del formuliario
    public function resetUI()
    {
        $this->nombre = '';
        $this->telefono = '';
        $this->localidad = '';
        $this->direccion = '';
        $this->email = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    //funcion editar
    public function edit($id)
    {
        $this->updateMode = true;

        $record = Empresa::find($id)->first();

        $this->selected_id = $record->id;
        $this->nombre = $record->nombre;
        $this->telefono = $record->telefono;
        $this->localidad = $record->localidad;
        $this->direccion = $record->direccion;
        $this->email = $record->email;
    }

    //crear registro//
    public function save()
    {
        $rules = [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'localidad' => 'required',
            'email' => 'required'
        ];

        $customMessages = [
            'nombre.required' => 'El campo Nombre es Requerido',
            'telefono.required' => 'El campo Telefono es Requerido',
            'direccion.required' => 'El campo direccion es Requerido',
            'localidad.required' => 'El campo localidad es Requerido',
            'email.required' => 'El campo email es Requerido'
        ];

        $this->validate($rules, $customMessages);

        if ($this->updateMode) {
            $empresa = Empresa::find($this->selected_id);
            $empresa->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'localidad' => $this->localidad,
                'direccion' => $this->direccion,
            ]);

            $this->emit('category-updated', 'Categoría Actualizada');
            $this->updateMode = false;
        } else {
            Empresa::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'localidad' => $this->localidad,
                'direccion' => $this->direccion,
            ]);

            $this->emit('msgok', 'Información de la empresa registrada');
        }

        $this->resetUI();
        $this->emit('toggleModal');
    }

    //eliminar registro//
    public function destroy($id)
    {
        if ($id) {
            $record = Empresa::find($id)->delete();

            $this->resetUI();
        }
    }

    public function render()
    {
        $Emp = Empresa::orderBy('id', 'asc')->paginate($this->pagination);

        if (strlen($this->search) > 0) {
            $Emp = Empresa::where('nombre', 'like', '%' .  $this->search . '%')
                ->orWhere('localidad', 'like', '%' .  $this->search . '%')
                ->orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.empresa.component', ['info' => $Emp]);
    }
}
