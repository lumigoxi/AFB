<div class="modal fade" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Editar Miembro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-cms-member" data-member="">
                    @csrf
                    <div class="form-group row">
                        <label for="desciption" class="col-md-3 col-form-label text-md-right">Descripción</label>
                        <div class="col-md-8 pt-1">
                           <textarea name="description" id="description" cols="40" rows="10"></textarea>
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