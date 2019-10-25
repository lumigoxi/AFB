@extends('dashboard.dashBase')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header py-0 pt-2">
  <div class="container-fluid">
      
            <div class="row mt-5 mx-5">
                <div class="col text-center mx-5">
              @if( session('admin'))
              <h1 class="alert alert-danger mx-5">{{ session('admin') }}</h1>
              @else
                <script>window.location = "/dashboard";</script>
              @endif
            </div>
            </div>
  </div>
</div>
      @endsection