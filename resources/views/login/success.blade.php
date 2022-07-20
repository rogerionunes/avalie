@extends('templates.templateLogin')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}">
    <img src="{{url('assets/dist/img/logo.png')}}" width="200px" alt="Avalie" style="opacity: .8">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

    <div class="row">
      <div class="col-3">
      </div>
      <div class="col-3">
      </div>
      <div class="col-3">
      </div>
    </div>

      <div class="alert alert-success alert-dismissible">
          <h5><i class="fa fa-check"></i> Avaliação realizada com sucesso! :)</h5>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
    
@endsection