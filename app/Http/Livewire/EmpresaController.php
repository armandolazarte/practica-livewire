<?php

namespace App\Http\Livewire;

use App\empresa;
use Livewire\Component;
use Livewire\WithPagination;

class EmpresaController extends Component
{
    use WithPagination;

    public $nombre, $direccion, $localidad, $telefono, $email, $pagetitle, $componentName;
    public $pagination = 5, $search, $selected_id, $record;


    public function mount()
    {

        $this->pagetitle = "Sucursales de la";
        $this->componentName = "Empresa";
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

    public function create()
    {
        return view('livewire.empresa.component');
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



        $empresa = Empresa::Create([

            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'localidad' => $this->localidad,
            'direccion' => $this->direccion,


        ]);

        $this->resetUI();
        $this->emit('msgok', 'Información de la empresa registrada');
        $this->emit('toggleModal');
    }

    //funcion editar

    public function edit()
    {
        $record = Empresa::find($id);
        $this->selected_id = $record->id;
        $this->nombre = $record->nombre;
        $this->telefono = $record->id;
        $this->selected_id = $record->id;
        $this->selected_id = $record->id;
    }
    //Actualizar datos de los registros//
    public function update($id)
    {
        $empresa = Empresa::find($this->selected_id);
        $empresa;


        $this->resetUI();
        $this->emit('category-updated', 'Categoría Actualizada');
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

    protected $listeners = [
        'deletereg'   => 'Destroy'
    ];


    //eliminar registro//
    public function destroy($id)
    {
        if ($id) {
            $record = Empresa::find($id)->delete();

            $this->resetUI();
        }
    }
}
