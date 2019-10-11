<div class="modal fade" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Editar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-activity">
                    @csrf
                    <div class="form-group row">
                        <label for="activity" class="col-md-3 col-form-label text-md-right">Actividad</label>
                        <div class="col-md-8">
                            <input id="activity" type="text" class="form-control" name="activity"  required  autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="located_at" class="col-md-3 col-form-label text-md-right">Lugar</label>
                        <div class="col-md-8">
                            <input id="located_at" type="text" class="form-control" name="located_at"  required  autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="decription" id="description" cols="40" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-md-3 col-form-label text-md-right">Fecha</label>
                        <div class="col-md-8">
                            <input id="date" type="datetime-local" class="form-control" name="date" required>
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