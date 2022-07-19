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
      <p class="login-box-msg">Digite login e senha para autenticar</p>

      <form action="{{ route('admin.login.autenticar')}}" method="post">
        @csrf

        @if($errors->all())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Erro!</h5>
          {{ $error }}
        </div>
        @endforeach
        @endif

        <?php 
        $text = isset($_GET('success')) ? '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="fa fa-check"></i> Deu tudo certo :)</h5></div>' : '';
        echo $text;
        ?>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name='email'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name='password'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Acessar</button>
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