<div  id="seeStory" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header row">
        <h5 class="modal-title font-weight-bold col-xs-2">Título:</h5>
        <h5 id="storyTitle" class="pl-1 modal-title text-capitalize col-xs-7 text-wrap"></h5>
        <span class="ml-5 mt-2 text-capitalize badge col-xs-2" id="status"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <p id="userName" class="modal-title ml-5 text-capitalize d-inline"></p>
      <p id="created_at" class="modal-title ml-5 text-capitalize"></p>
      <div class="modal-body mx-2">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <label for="description">Decripción: </label><br>
              <p id="description" class="text-wrap"style="word-break: break-all; white-space: normal;"></p>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                    <label>Datos de la adopación: </label>
                </div>
                <div class="col-md-12">
                  <label for="nameOwner">Nombre: </label>
                    <span id="nameOwner"></span>
                </div>
                <div class="col-md-12">
                    <label for="petName">Mascota: </label>
                    <span id="petName"></span>
                </div>
                <div class="col-md-12">
                    <label for="petBreed">Raza: </label>
                    <span id="petBreed"></span>
                </div>
                <div class="col-md-12">
                    <label for="dateAdopted">Fecha de adopación: </label>
                    <span id="dateAdopted"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>