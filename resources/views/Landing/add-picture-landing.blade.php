<div class="modal fade" id="modal-add-picture">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar fotografía</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-add-picture" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label">Fotografía</label>
            <input type="file" name="path" class="form-control" id="file-picture">
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

