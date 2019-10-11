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
                    <a href="#" class="btn btn-warning btn-sm btn-edit-page" data-toggle="modal" data-target="#edit-page">Editar página</a>
                    <a href="{{ route('/') }}" class="btn btn-info btn-sm" target="_blank">Ver Landing</a>
                    <hr>
                    <table id="memberTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Publicar</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                    </table>
                    @include('member.create')
                    @include('landing.member.edit')
                    @include('Landing.member.more')
                    @include('Landing.member.edit-page')
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
        //FUNCIOON CARGAR TABLA
        function showTable(){
        $('#memberTable').DataTable({
        "serverSide": true,
        "ajax": {
            "url": "{{ url('miembros/getAllUser') }}",
            "data": { 
            "request_url": "cms"
        }
        },
        "columns": [
        {data: 'id'},
        {data: 'name'},
        {data: 'visible', mRender:function(data, type, row){
            if (data == 'Listado') {
                return `<div class="text-center">
                    <a href="#" class="badge badge-success btn-listar"  data-visible="1">`+data+`</a>
                </div>`;
            }else{
                return `<div class="text-center">
                    <a href="#" class="badge badge-danger btn-listar" data-visible="0">`+data+`</a>
                </div>`;
            }
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
        } );



        

        //logica para consultar descripcion actual
        $('body').on('click', '#memberTable .btn-editar', function(e){
            let idMember = $(this).attr('data-member')
            let request_url = '{{ route('cms-miembros.show', ':idMember') }}'
            request_url = request_url.replace(':idMember', idMember)
            $.ajax({
                type: 'get',
                url: request_url, 
                success: function(data){
                    $('#description').val(data.description)
                    $('#form-edit-cms-member').attr('data-member', data.id)
                }
            })
        })

        //logica para actualizar miembro
    $('#form-edit-cms-member').on('submit', function(e){
        e.preventDefault()
        let idMember = $(this).attr('data-member')
        let url = '{{ route('cms-miembros.update', ':idMember') }}'
        url = url.replace(':idMember', idMember)
        $.ajax({
            type: 'put',
            url: url,
            data: $(this).serialize(),
            success: function(data){
                $('#editModal').modal('toggle')
                if (data == 1) {
                    swal('Exitiso', 'Se ha actualizado la descripción', 'success')
                }else{
                    swal('Error', 'Algo salió mal', 'error')
                }
            }
        })
    })


         $('body').on("click", "#memberTable .seeMember",function(e){
    e.preventDefault();
      let row = $(this).parents('tr');
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.get(url, form.serialize(), function(data){
        let title = document.getElementById('see-user-name');
        let description = document.getElementById('see-member-description');
        title.innerHTML=data['name'];
        description.innerHTML = data['description'];
      })
  });

         $('body').on("click", "#memberTable .btn-listar", function(e){

            //ESTE SELECTOR APUNTA AL ID DEL MIEMBRO
            let tag_currently = $(this)
            const idMember = $(this).parent().parent().siblings('td').children('form:first-child').children('a').attr('data-member')
            let request_url = "{{ route('cms-miembros.update', ':idMember') }}"
            request_url = request_url.replace(':idMember', idMember)
            let token = '{{ csrf_token() }}'
            let visible = $(this).attr('data-visible')
            visible = parseInt(visible)
            let data = {visible: visible, _token:token}
            $.ajax({
                type: 'put',
                url: request_url,
                data: data,
                success: function(data){
                    if (data) {
                        if (visible == 0) {
                            tag_currently.attr('data-visible', 1)
                            tag_currently.removeClass('badge-danger')
                            tag_currently.addClass('badge-success')
                            tag_currently.text('Listado')
                            swal("Actualizado!", "EL usuario ha sido listado", "success")
                        }else if(visible == 1){
                            tag_currently.attr('data-visible', 0)
                            tag_currently.removeClass('badge-success')
                            tag_currently.addClass('badge-danger')
                            tag_currently.text('No listado')
                            swal("Actualizado!", "EL usuario no ha sido listado", "success")

                        }
                    }else{
                        swal("Error", "Algo ha salido mal", "error")
                    }
                }
            })

         })


    $('.btn-edit-page').on('click', function(e){
    e.preventDefault()
    url = '{{ route('pages.show', ':idPage') }}'.replace(':idPage', 3)
    $.ajax({
        type: 'get',
        url: url,
        success: function(data){
          let page = document.getElementById('see-name-page')
          let description = document.getElementById('see-text-page')
          $('#see-text-page').val(data['text'])
          $('#see-title-page').val(data['title'])
          page.innerHTML = data['page']
          $('#form-edit-page').attr('data-page', data['id'])
        }
    })
})


    $('#form-edit-page').on('submit',function(e){
      e.preventDefault()
      let idPage = $(this).attr('data-page')
      let url = '{{ route('pages.update', ':idPage') }}'.replace(':idPage', idPage)
      let form = $(this).serialize()

      $.ajax({
          url: url,
          data: form,
          type: 'put',
          success: function(data){
            $('#edit-page').modal('toggle')
            if (data == 1) {
              swal({
                title: 'Exitoso',
                text: 'Se ha acutualizado al pagina',
                icon: 'success',
                timer: 3000
              })
            }else{
              swal({
                title: 'Error',
                text: 'Algo salió mal',
                icon: 'error',
                timer: 2500
              })
            }
          }
      })
  })

        </script>
        @endsection

