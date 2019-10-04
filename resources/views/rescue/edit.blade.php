                    
<div class="modal fade" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Editar rescate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form-edit-rescue">
                        @csrf
                         <div class="form-group row">
                            <label for="user_id" class="col-md-3 col-form-label text-md-right">Encargado</label>
                            <div class="col-md-8">
                                <input type="text" id="input-search-user" class="form-control mb-2">
                                <label for="name">Nombre:</label>
                                <input type="email" id="name"  readonly class="form-control mb-2">
                                <label for="email">Email:</label>
                                <input type="email" id="email"  readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reason" class="col-md-3 col-form-label text-md-right">Razon</label>
                            <div class="col-md-8">
                                <input id="reason" type="text" class="form-control" requerid name="reason"   autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-8">
                                <textarea class="form-control" requerid name="description" id="description" cols="40" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="located_at" class="col-md-3 col-form-label text-md-right">Lugar</label>
                            <div class="col-md-8">
                                <input id="located_at" type="text" class="form-control" requerid name="located_at"   autofocus>
                            </div>
                        </div>

                            <div class="modal-footer d-flex">
        <button type="submit" class="btn btn-success">Guardad</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>             
                    </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
     
   