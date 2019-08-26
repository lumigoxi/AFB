@extends('layouts.app')

@section('content')
            <div class="container pt-4">
                <div class="row">
                    <div class="col-md-2 bg-dark py-4 rounded">
                        <a href="{{ Route('miembros.index') }}" class="btn btn-success btn-sm btn-block">Miembros</a>
                        <a href="{{ Route('historias.index') }}" class="btn btn-success btn-sm btn-block">Historias</a>
                        <a href="{{ Route('rescates.index') }}" class="btn btn-success btn-sm btn-block">Rescates</a>
                        <a href="{{ Route('tratamientos.index') }}" class="btn btn-success btn-sm btn-block">Tratamiento</a>
                    </div>
                    <div class="col-md-10">
                    </div>
                </div>
            </div>
@endsection
