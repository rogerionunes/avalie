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
      <div class="col-3">
        <a href="{{ route('admin')}}" class="btn btn-block btn-primary btn-xs" style="color: white">Admin <i class="fa fa-sign-in-alt"></i></a>
      </div>
    </div>
      <p class="login-box-msg">Digite o PIN no campo abaixo</p>

      <form action="{{ route('admin.avaliacao.sessao')}}" method="get">

        @if($errors->all())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Erro!</h5>
          {{ $error }}
        </div>
        @endforeach
        @endif

        @if(Request::segment(0) != '')
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <h5><i class="fa fa-check"></i> Avaliação gravada com sucesso!</h5>
          </div>
        @endif

        <div class="input-group mb-3">
          <input type="text" class="form-control" maxlength="6" placeholder="PIN" name='pin' id='pin'>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sessão</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
    
@endsection