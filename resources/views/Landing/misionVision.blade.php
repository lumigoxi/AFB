@extends('dashboard.dashBase')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header py-0 pt-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Misión y Visión</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 py-auto">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Langing</li>
            <li class="breadcrumb-item active">Misión y Visión</li>
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
                  <div class="col-md-12">
                    <hr>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
                    <a href="{{ route('/') }}" class="btn  btn-info" target="_blank">Ver Landing</a>
                    <hr>
                  </div>
                <div class="row">
                    <form class="pl-2" id="form-mission-vision">
                      <label for="mision">Misión</label>
                      <div class="form-group col-md-12">
                        <textarea name="mission" cols="100" rows="5" id="text-mission">
                        
                        </textarea>
                      </div>
                      <label for="vision">Visión</label>
                      <div class="form-group col-md-12">
                        <textarea name="vision" cols="100" rows="5" id="text-vision">
                        
                        </textarea>
                      </div>
                      <button type="submit" class="btn btn-success" id="submit-mission-vision">Actualizar</button>
                    </form>
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
        function getMisionVision(){
        $.ajax({
        type: 'GET',
        url: '{{ route('mision-vision.show', 1)}}',
        success: function(result){
          let textMission = $('#text-mission').val(result[0]['mission'])
          let textVision = $('#text-vision').val(result[0]['vision'])
        }
        })
        }

        $(document).ready(function(){
          getMisionVision()
          $('#submit-mission-vision').click(function(e){
            let textMission = $('#text-mission').val()
            let textVision = $('#text-vision').val()
            let token = '{{csrf_token()}}'
              e.preventDefault()
              $.ajax({
                type: 'put',
                url:'{{ route('landing.update', 1) }}',
                data: {
                    mission:textMission,
                    vision:textVision,
                    _token:token
                },
                success:function(result){
                  if (result === 'ok') {
                    swal("Actualizado", "Los datos fueron actualizados exitosamente", "success")
                  }else{
                    swal("Error", "No se pudo actualizar los datos", "error")
                    getMisionVision()
                  }
                  
                }
              })
          })
        })
        </script>
        @endsection