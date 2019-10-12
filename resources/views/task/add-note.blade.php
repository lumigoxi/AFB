                    
<div class="modal fade" id="modal-note">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Editar rescate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="form-add-note">
                        @csrf
                        <div class="form-group row">
                            <label for="note" class="col-md-3 col-form-label text-md-right">Nota adicional</label>
                            <div class="col-md-8">
                                <textarea class="form-control" requerid name="note" id="note" cols="40" rows="5"></textarea>
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
     
   