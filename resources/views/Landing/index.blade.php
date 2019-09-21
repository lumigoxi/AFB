@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de miembros</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Miembros</li>
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
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-user">Crear nuevo Miembro</a>
				<hr>
        {!! Form::open(['route'=>['landing.update', 1], 'method'=> 'POST']) !!}
            {!! Form::textarea('call_to_action', null, ['id' => 'editor1', 'rows' => 10, 'cols' => 80, 'class' => 'ckeditor']) !!}
            <div class="form-group">
               <label for="mision">Mision</label>
                <input type="text" class="form-control" id="mision" value="{{ $landing->mission }}">
          </div>
          <div class="form-group">
               <label for="vision">Vision</label>
                <input type="text" class="form-control" id="vision" value="{{ $landing->vision }}">
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
              CKEDITOR.instances.editor1.setData('');
           }

        });
  });
</script>
@endsection