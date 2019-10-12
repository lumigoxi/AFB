<div  id="seeMessage" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Remitente: &nbsp</h5>
        <h5 id="header-message" class="modal-title text-capitalize"></h5>
        <span class="ml-5 mt-2 badge" id="status"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <p id="reason-message" class="modal-title ml-5 text-capitalize d-inline"></p>
      <p id="date-message" class="modal-title ml-5 text-capitalize"></p>
      <div class="modal-body mx-2">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <label for="email">Correo: </label>
              <span id="email"></span>
            </div>
            <div class="col-md-6">
              <label for="telephone">Teléfono: </label>
              <span id="telephone"></span>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <label for="message">Mensaje: </label>
              <span id="message"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>