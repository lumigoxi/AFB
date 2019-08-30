                    
<div class="modal fade" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Creacion de miembro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-8">
                                <input id="newName" type="text" class="form-control @error('name') is-invalid @enderror" name="newName" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newEmail" class="col-md-3 col-form-label text-md-right">Correo</label>

                            <div class="col-md-8">
                                <input id="newEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="newEmail" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newPassword" class="col-md-3 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-8">
                                <input id="newPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="mewPassword" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newPassword-confirm" class="col-md-3 col-form-label text-md-right">Confirmar contraseña</label>

                            <div class="col-md-8 pt-1">
                                <input id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation" required autocomplete="new-password">
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
     
   