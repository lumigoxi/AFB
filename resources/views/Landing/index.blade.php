@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Call to action</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Langing</li>
              <li class="breadcrumb-item active">Call to action</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="container">
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>                                            <a href="{{ route('/') }}" class="btn  btn-info" target="_blank">Ver Landing</a>
				<hr>
        {!! Form::open(['route'=>['landing.update', 1], 'method'=> 'POST']) !!}
              <div class="form-group">  
              {!! Form::textarea('call_to_action', null, ['id' => 'editor1', 'rows' => 10, 'cols' => 80, 'class' => 'ckeditor']) !!}
              </div>
            <button type="submit" class="btn btn-success" id="submitLandig">Guardar</button>
        {!! form::close() !!} 
			</div>
		</div>
	</div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

<script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.config.allowedContent = true;
</script>
<script>

  function update_ckEditor(){
    $.ajax({
      type: 'GET',
      url: '{{ route('landing.show', 1)}}',
      success: function(result){
          CKEDITOR.instances.editor1.setData(result.call_to_action);
      }
    })
  }
  $(document).ready(function(){
      update_ckEditor()
  })

  $('body').on("click", "#submitLandig",function(e){
    e.preventDefault();
    let form = $(this).parents('form');
    let url = form.attr('action');
    let token = '{{csrf_token()}}'
    let textarea = CKEDITOR.instances.editor1.getData();
    let data = {call_to_action:textarea, _token:token};
         $.ajax({

           type:'put',

           data: data,

           url:url,


           success:function(data){
              swal("Actualizado!", "El call to action fue actualizado", "success");
           }

        });
  });
</script>
@endsection