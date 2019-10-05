                    
<div class="modal fade" id="modal-edit-pet">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Registrar Mascota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form-edit-pet">
                        @csrf
                        <div class="form-group row">
                            <label for="input-search-pet" class="col-md-3 col-form-label text-md-right">Mascota</label>
                            <div class="col-md-8">
                                <input id="input-search-pet" type="text" class="form-control" readonly autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description" id="description" cols="40" rows="10"></textarea>
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
     
   