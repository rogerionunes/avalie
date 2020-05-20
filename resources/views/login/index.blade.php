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
      <p class="login-box-msg">Digite o PIN no campo abaixo</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="codigo" class="form-control" placeholder="PIN" name='codigo'>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="button" class="btn btn-primary btn-block">Iniciar Avaliação</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
    
@endsection