                    
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
          <form method="POST" action="{{ route('historias.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="titulo" class="col-md-3 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-8">
                                <input id="titulo" type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ old('title') }}" required autocomplete="titulo" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Descripcion" class="col-md-3 col-form-label text-md-right">Descripion</label>

                            <div class="col-md-8">
                                <input id="Descripcion" type="email" class="form-control @error('description') is-invalid @enderror" name="text" value="{{ old('desciption') }}" required autocomplete="description">

                                @error('desciption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img" class="col-md-3 col-form-label text-md-right">Imagen</label>

                            <div class="col-md-8">
                                <input id="img" type="password" class="form-control @error('img') is-invalid @enderror" name="img" required>

                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
     
   