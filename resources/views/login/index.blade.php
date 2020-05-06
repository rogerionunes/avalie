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

      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="codigo" class="form-control" placeholder="Código" name='codigo'>
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