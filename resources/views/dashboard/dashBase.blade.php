<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('img/amigo-fiel-logo.jpg') }}" style="border-radius: 50%;">
    <title>AMIGO FIEL</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/jqvmap/jqvmap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/chart.js/Chart.min.css') }}">
    <!-- summernote -->
    {{--   <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
    --}}  <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/utilidades.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}">
    <link href="{{ URL::asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    @yield('style')
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navbar -->
      @include('dashboard.dashNavbar')
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ URL::asset('bower_components/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
          <span class="brand-text font-weight-light">AMIGO FIEL</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          @include('dashboard.sidebar')
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper bg-white">
        @yield('content')
        <div class="container-fluid">
          <div class="row mt-3">
            @if(Auth::user()->role >= 1 && Request::path() ==  'dashboard')
            <div class="col-lg-3 col-6">
              <a href="{{ route('Solicitudes.index') }}" id="card-requests">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3></h3>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-paw"></i>
                  </div>
                  <span class="small-box-footer">Ir a modulo de Solicitudes &nbsp<i class="fas fa-arrow-circle-right"></i></span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-6">
              <a href="{{ route('Mascotas.index') }}" id="card-pets">
                <div class="small-box bg-success">
                  <div class="inner text-white">
                    <h3></h3>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-dog"></i>
                  </div>
                  <span class="small-box-footer">Ir a modulo de mascotas(TPS) &nbsp<i class="fas fa-arrow-circle-right"></i></span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-6">
              <a href="{{ route('Mensajes.index') }}" id="card-messages">
                <div class="small-box bg-warning">
                  <div class="inner text-white">
                    <h3></h3>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <span class="small-box-footer">Ir a modulo de mensajes &nbsp<i class="fas fa-arrow-circle-right"></i></span>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-6">
              <a href="{{ route('rescates.index') }}" id="card-rescues">
                <div class="small-box bg-danger">
                  <div class="inner text-white">
                    <h3></h3>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ambulance"></i>
                  </div>
                  <span class="small-box-footer">Ir a modulo de rescates &nbsp<i class="fas fa-arrow-circle-right"></i></span>
                </div>
              </a>
            </div>
            @else
            @endif
          </div>
          @if(Auth::user()->role >= 1 && Request::path() ==  'dashboard')
          <div class="row text-center mt-4">
            <div class="col"><h2>Estadística</h2></div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12 text-center mb-3">
              <h4 id="title-rescues"></h4>
              <canvas id="rescue-diagram" width="400" height="200"></canvas>
            </div>
             <div class="col-lg-6 col-12 text-center">
              <h4 id="title-pets"></h4>
              <canvas id="pets-diagram" width="400" height="200"></canvas>
            </div>
          @endif
          </div>
        </div>
      </div>
      <!-- /.content-wrapper -->
      @include('dashboard.footer')
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <div class="modal fade" id="modalPasswordReset" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cambiar contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('ownResetPassword') }}" id="formPasswordReset">
              @csrf
              <div class="form-group row">
                <label for="passwordCurrent" class="col-md-5">Contraseña actual</label>
                <input type="password" class="form-control col-md-7" id="passwordCurrent" name="password">
              </div>
              <div class="form-group row">
                <label for="newPassword" class="col-md-5">Nueva Contraseña</label>
                <input type="password" class="form-control col-md-7" id="newPassword" name="newPassword">
              </div>
              <div class="form-group row">
                <label for="passwordConfirm" class="col-md-5">Confirmar contraseña</label>
                <input type="password" class="form-control col-md-7" id="passwordConfirm" name="newPasswordConfirm">
              </div>
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <!-- Sparkline -->
    {{-- <script src="{{ URL::asset('bower_components/admin-lte/plugins/sparklines/sparkline.js') }}"></script> --}}
    <!-- JQVMap -->
    {{-- <script src="{{ URL::asset('bower_components/admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('bower_components/admin-lte/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    <!-- daterangepicker -->
    <script src="{{ URL::asset('js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- Summernote -->
    <!-- overlayScrollbars -->
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- FastClick -->
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('bower_components/admin-lte/dist/js/adminlte.js') }}"></script>
    <script src="{{ URL::asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}">
    </script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
    @yield('scripts')
    <script>
    $('#formPasswordReset').on('submit', function(e){
      e.preventDefault()
      let data = $(this).serialize()
      let url = $(this).attr('action')
      $.ajax({
        url: url,
        data: data,
        type: 'post',
        success: function(result){
          $('#modalPasswordReset').modal('toggle')
          $('#passwordCurrent').val('')
          $('#newPassword').val('')
          $('#passwordConfirm').val('')
          if (result == 1) {
            swal({
              title: 'Exitiso',
              text: 'Se ha actualizado la contraseña con exito',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
              title: 'Oops',
              tetx: 'Algo salio mal',
              icon: 'info',
              timer: 2500
            })
          }
        }
      })
    })

@if(Auth::user()->role >= 1 && Request::path() ==  'dashboard')
function loadCards(){
  let url = '{{ url('infoDashboard') }}'
      $.ajax({
        url: url,
        type: 'get',
        success: function(data){
          $('#card-messages h3').text(data.Messages['NotSeen'])
          $('#card-messages p').text((data.Messages['NotSeen'] != 1 ? 'Mensajes nuevos' : 'Mensaje nuevo'))
          $('#card-pets h3').text(data.Pets['pets'])
          $('#card-pets p').text((data.Pets['pets'] != 1 ? 'Mascotas disponibles' : 'Mascota disponibles'))
          $('#card-requests h3').text(data.RequestsPets['NotSeen'])
          $('#card-requests p').text((data.RequestsPets['NotSenn'] != 1 ? 'Solicitudes sin leer' : 'Solicitud leer'))
          $('#card-rescues h3').text(data.Rescues['NotAttend'])
          $('#card-rescues p').text((data.Rescues['NotAttend'] != 1 ? 'Rescates sin atender' : 'Rescate sin atender'))
        }
      })
}

function loadDiagram(data, ctx, field){
  let dates = [
             moment().startOf('month').subtract(6, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(5, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(4, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(3, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(2, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(1, 'months').format('MMM YYYY'),
             moment().startOf('month').subtract(0, 'months').format('MMM YYYY')
       ]
  let myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: dates,
    datasets: [{
      label: field[0],
      data: [
        {
          t: dates[0],
          y: data.done[0]
        },
        {
          t: dates[1],
          y: data.done[1]
        },
        {
          t: dates[2],
          y: data.done[2]
        },
        {
          t: dates[3],
          y: data.done[3]
        },
        {
          t: dates[4],
          y: data.done[4]
        },
        {
          t: dates[5],
          y: data.done[5]
        },
        {
          t: dates[6],
          y: data.done[6]
        }
      ],
      backgroundColor: [
        'rgba(74, 135, 72, 0.3)'
      ],
      borderColor: [
        'rgba(74,135,72,1)'
      ],
      borderWidth: 1
    },
    {
      label: field[1],
      data: [
        {
          t: dates[0],
          y: data.nd[0]
        },
        {
          t: dates[1],
          y: data.nd[1]
        },
        {
          t: dates[2],
          y: data.nd[2]
        },
        {
          t: dates[3],
          y: data.nd[3]
        },
        {
          t: dates[4],
          y: data.nd[4]
        },
        {
          t: dates[5],
          y: data.nd[5]
        },
        {
          t: dates[6],
          y: data.nd[6]
        }
      ],
      backgroundColor: [
       'rgba(255, 99, 132, 0.3)'
      ],
      borderColor: [
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    },
    {
      label: field[2],
      data: [
        {
          t: dates[0],
          y: data.inProgress[0]
        },
        {
          t: dates[1],
          y: data.inProgress[1]
        },
        {
          t: dates[2],
          y: data.inProgress[2]
        },
        {
          t: dates[3],
          y: data.inProgress[3]
        },
        {
          t: dates[4],
          y: data.inProgress[4]
        },
        {
          t: dates[5],
          y: data.inProgress[5]
        },
        {
          t: dates[6],
          y: data.inProgress[6]
        }
      ],
      backgroundColor: [
        'rgba(65, 131, 215, 0.3)'
      ],
      borderColor: [
        'rgba(65, 131, 215, 1)'
      ],
      borderWidth: 1
    }
    ]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
})
}


function sumArray(array){
  let total = 0;
    $.each(array, function(key, value){
        $.each(value, function(key, value){
          total+=value
        })
    })
  return total != 1 ? total+' registrados' : total+' registrado'
}


function diagramPetsAdopts(){

  $.ajax({
    url: '{{ url('getInfoDiagram') }}',
    type: 'get',
    success: function(data){
    let rescues = data.rescues
    let pets = data.pets
    let ctx = document.getElementById('rescue-diagram').getContext('2d');
    let ctx2 = document.getElementById('pets-diagram').getContext('2d');
    loadDiagram(data.rescues, ctx, ['Listo', 'Sin Definir', 'En Progreso'])
    $('#title-rescues').text('Rescates: '+sumArray(rescues) )
    loadDiagram(data.pets, ctx2, ['Recuperado', 'Sin Definir', 'En Tratamiento'])
    $('#title-pets').text('Mascotas: '+sumArray(pets) )
    }
  })
}

    $(document).ready(function(){
      moment.locale('es')
      loadCards()
      diagramPetsAdopts()
    })

@endif
    </script>
  </body>
</html>