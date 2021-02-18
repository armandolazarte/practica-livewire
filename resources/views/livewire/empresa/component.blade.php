<div class="card">
    <div class="card-header">
        <h4 class="card-title"><b>{{ $componentName }}</b> | {{ $pageTitle }}</b></h4>
        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEmpresa">
             + Agregar Empresa
        </button>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Localidad</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($info as $r)
                    <tr>
                        <td>{{ $r->nombre }}</td>
                        <td>{{ $r->direccion }} </td>
                        <td>{{ $r->localidad }}</span></td>
                        <td>{{ $r->telefono }}</td>
                        <td>{{ $r->email }}</td>
                        <td>
                            <button type="button" wire:click="edit({{ $r->id }})"
                                class="btn btn-block btn-outline-warning btn-xs" data-toggle="modal"
                                data-target="#modalEmpresa">Editar</button>
                            <button type="button" wire:click.prevent="destroy()"
                                class="btn btn-block btn-outline-danger btn-xs">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('livewire.empresa.modal')

    @push('scripts')
        <script>
            window.livewire.on('toggleModal', () => $('#modalEmpresa').modal('toggle'));
        </script>
    @endpush
</div>
