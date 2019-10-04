                    
<div class="modal fade" id="modal-add-pet">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Registrar Mascota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form-register-pet">
                        @csrf
                     

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" requerid name="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lbreed" class="col-md-3 col-form-label text-md-right">Raza</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="breed" id="breed">
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
     
   