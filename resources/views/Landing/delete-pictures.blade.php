<div class="modal fade" id="delete-pictures" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
          
        </ol>
        <div class="carousel-inner list-pictures" role="listbox">
          
        </div>
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        {!! Form::open(['route'=>['addPageImage.destroy', 3], 'method'=> 'DELETE']) !!}
        <a href="#" class="carousel-caption" id="delete-image" style="margin-left: 32%;">
          <i class="fa fa-trash fa-2x"></i>
        </a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>