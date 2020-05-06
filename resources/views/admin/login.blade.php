@extends('templates.templateLogin')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Ava</b>lie</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Acesse para iniciar a sessão</p>

      <form action="{{ route('admin.login.autenticar')}}" method="post">
        @csrf

        @if($errors->all())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Erro!</h5>
          {{ $error }}
        @endforeach
        @endif

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name='email' value='rogerionunes90@gmail.com'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name='password' value='12345678'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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