<div  id="edit-page" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 id="see-name-page" class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <form id="form-edit-page">
                        @csrf
                        <div class="form-group row">
                            <label for="see-title-page" class="col-md-3 col-form-label text-md-right">Titulo</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="title" id="see-title-page" cols="10" rows="3"></textarea>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="see-text-page" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="text" id="see-text-page" cols="40" rows="10"></textarea>
                            </div>
                        </div>
                         <div class="modal-footer d-flex">
        <button type="submit" class="btn btn-success">Guardad</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div> 
                      </form>
      </div>
    </div>
  </div>
</div>