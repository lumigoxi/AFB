<div class="modal fade" id="see-pictures" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div id="carousel-all-pict" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators control-story" id="story-list">
          
        </ol>
        <div class="carousel-inner list-pictures" role="listbox">
          
        </div>
        <a class="carousel-control-prev" href="#carousel-all-pict" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-all-pict" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        {!! Form::open(['route'=>['imagenes.destroy', ':idImage'], 'method'=> 'DELETE']) !!}
        <a href="#" class="carousel-caption" id="delete-image">
          <i class="fa fa-trash fa-2x"></i>
        </a>
        {!! Form::close() !!}
        <a href="#" class="option-carousel carousel-option select-image">
          <i class="fa fa-check-circle fa-2x"></i>
        </a>
      </div>
    </div>
  </div>
</div>