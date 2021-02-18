 <!--inicio modal-->
 <div wire:ignore.self class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-warning">
             <!--encabezado del modal-->
             <div class="modal-header">
                 <h4 class="modal-title">Datos de la empresa</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <!--fin del encabezado del modal-->
             <!--cuerpo del modal-->
             <div class="modal-body">
                 <form role="form" method="post">
                     <div class="form-group">
                         <label for="inputName">Nombre:</label>
                         <input wire:model="nombre" type="text" class="form-control" id="nombre" />
                     </div>
                     <div class="form-group">
                         <label for="inputdireccion">Direccion:</label>
                         <input wire:model="direccion" type="text" class="form-control" id="direccion" />
                     </div>
                     <div class="form-group">
                         <label for="inputlocalidad">Localidad:</label>
                         <input wire:model="localidad" type="text" class="form-control" id="localidad" />
                     </div>
                     <div class="form-group">
                         <label for="inputtelefono">Telefono:</label>
                         <input wire:model="telefono" type="text" class="form-control" id="telefono" />
                     </div>
                     <div class="form-group">
                         <label for="inputEmail">Email:</label>
                         <input wire:model="email" type="email" class="form-control" id="email" />
                     </div>

                 </form>
             </div>
             <!--fin del cuerpo del modal-->
             <!--pie del modal-->
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                 <button type="button" wire:click.prevent="save()" class="btn btn-outline-dark">Guardar</button>
             </div>
             <!--fin del pie del modal-->
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>