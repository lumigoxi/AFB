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
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Regresar</a>
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-user">Crear nuevo Miembro</a>
				<hr>
        <table id="memberTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Estado</th>
                <th scope="col">Role</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
        @include('member.create')
			</div>
		
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script>
  //FUNCIOON CARGAR TABLA
  function showTable(){
    $('#memberTable').DataTable({
      "serverSide": true,
     "ajax": {
            "url": "{{ url('miembros/getAllUser') }}",
            "data": { 
            "request_url": "tps"
        }
        },
      "columns": [
      {data: 'name'},
      {data: 'email'},
      {data: 'status', mRender: function(data, display, row){
        if (data == 'Activo') {
                return `<div class="text-center">
                    <a href="#" class="badge badge-success btn-status" data-member="`+row.id+`" data-status="0">`+data+`</a>
                </div>`;
            }else{
                return `<div class="text-center">
                    <a href="#" class="badge badge-danger btn-status" data-member="`+row.id+`" data-status="1">`+data+`</a>
                </div>`;
            }
      }},
      {data: 'role', mRender: function(data, display, row){
        if (data == 'Super Admin') {
          return `<div class="text-center">
                    <a href="#" class="badge badge-success btn-role" data-role="10" data-member="`+row.id+`">`+data+`</a>
                </div>`
        }
        if (data == 'Admin') {
          return `<div class="text-center">
                    <a href="#" class="badge badge-info btn-role" data-role="0" data-member="`+row.id+`">`+data+`</a>
                </div>`;
        }else{
          return `<div class="text-center">
                    <a href="#" class="badge badge-secondary btn-role" data-role="1" data-member="`+row.id+`">`+data+`</a>
                </div>`;
        }
      }},
      {data: 'created_at', mRender: function(data){
        return moment(data).format('lll');
      }},
      {data: 'btn'},
      ],
      "language":{
        "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
        "search": "Buscar",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
                  },
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
                }
                            });
  }

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable();
    moment.locale('es')
} );


  $('#form-add-member').on('submit', function(e){
    e.preventDefault()
    let url = $(this).attr('action')
    let data = $(this).serialize()

      $.ajax({
        url: url,
        data: data,
        type: 'post',
        success: function(data){
          $('#create-user').modal('toggle')
          if (data == 1) {
            $('#name').val('')
            $('#email').val('')
            $('#password').val('')
            $('#password-confirm').val('')
            $('#memberTable').DataTable().ajax.reload()
            swal({
              title: 'Exitiso',
              text: 'El usuario ha sido creado',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
            title: 'Error',
            text: 'Algo salio mal',
            icon: 'info',
            timer: 3000
          })
          }
        },
        error: function(errors){
          swal({
            title: 'Error',
            text: 'Correo electronico ya ha sido utilizado',
            icon: 'info',
            timer: 3000
          })
        }
      })
  })


    //ELIMINAR MIEMBRO | NO HACE FALTA CARGAR LA TABLA  
    $('body').on("click", "#memberTable .borrarMiembro",function(e){
      e.preventDefault();
      swal({
  title: "¿Seguro de eliminar al miembro?",
  text: "Una vez eliminado no se podra revertir el cambio",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
       let idMember = $(this).attr('data-member')
       let form = $(this).parent('form').serialize()
      let url = '{{ route('miembros.destroy', ':idMember') }}'.replace(':idMember', idMember)
      $.post(url, form, function(data){
           if (data == 1) {
          $ ('#memberTable').DataTable().ajax.reload()
            swal({
            title: 'Exitiso',
            text: 'Se ha eliminado correctamente',
            icon: 'success',
            timer: 3000
          })
          }else if(data == 0){
            swal({
            title: 'Oops',
            text: 'Algo salio mal',
            icon: 'info',
            timer: 3000
          })
          }else{
            swal('Error', data, 'error')
          }
      })
  }
})
    })


     $('body').on('click' ,'#memberTable .btn-status', function(e){
        e.preventDefault();
        let tag_currently = $(this)
        const idMember = $(this).attr('data-member')
        let url = '{{ route('miembros.update', ':idMember') }}'
        url = url.replace(':idMember', idMember)
        let status = $(this).attr('data-status')
        let data = {
          status: status,
          request_url: 'tps',
          _token: '{{ csrf_token() }}'
        }

        $.ajax({
        type: 'put',
        url: url,
        data: data,
        success: function(data){
           if (data == 1) {
                  $('#memberTable').DataTable().ajax.reload()
                  swal('Exitoso', 'Se actualizo correctamente', 'success')
                    }else if(data == 0){
                      swal("Error", 'Algo salio mal', "error")
                    } else{
                        swal("Error", data, "error")
                    }

        }
        })
     })
</script>
<script>
   $('body').on('click' ,'#memberTable .btn-role', function(e){
        e.preventDefault();
        const idMember = $(this).attr('data-member')
        let url = '{{ route('miembros.update', ':idMember') }}'
        url = url.replace(':idMember', idMember)
        let role = $(this).attr('data-role')
        let data = {
          role: role,
          request_url: 'tps',
          _token: '{{ csrf_token() }}',
          origin: 'role'
        }
                

        $.ajax({
        type: 'put',
        url: url,
        data: data,
        success: function(data){
           if (data == 1) {
                  $('#memberTable').DataTable().ajax.reload()
                  swal('Exitoso', 'Se actualizo correctamente', 'success')
                    }else if(data == 0){
                      swal("Error", 'Algo salio mal', "error")
                    } else{
                        swal("Error", data, "error")
                    }

        }
        })
     })
</script>
@endsection