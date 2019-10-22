<div class="modal fade" id="create-story">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Nueva Historia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('historias.store') }}" id="form-add-story">
          @csrf
          <div class="form-group row">
            <label for="adopted" class="col-md-3 col-form-label text-md-right">Adopción</label>
           <div class="col-md-8">
              <select class="form-control" id="adopted" name="request_pets_id">
            </select>
           </div>
          </div>
          <div class="form-group row">
            <label for="titulo" class="col-md-3 col-form-label text-md-right">Titulo</label>
            <div class="col-md-8">
              <input id="titulo" type="text" class="form-control" name="title" required autocomplete="titulo" autofocus>
            </div>
          </div>
          <div class="form-group row">
            <label for="Descripcion" class="col-md-3 col-form-label text-md-right">Descripion</label>
            <div class="col-md-8">
              <textarea name="text" id="Description" cols="30" rows="8" required="true"></textarea>
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