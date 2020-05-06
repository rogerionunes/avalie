@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Adicionar Usuário</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Usuário</li>
              <li class="breadcrumb-item active">Adicionar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
          <form action='{{ route('admin.users.addUser') }}' method='POST'>
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

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="nome" require>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" require>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Senha</label>
                  <input type="password" class="form-control" name="senha" require>
                </div>
                <div class="form-group">
                  <label>Tipo de Usuário</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='tipoUsuario' style="width: 100%;" require>
                    <option value='P'>Professor</option>
                    <option value='C'>Coordenador</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Cadastrar Usuário</button>
                <a class="btn btn-danger" href="{{ route('admin.users.list') }}">Cancelar</a>
              </div>
            </div>

          </form>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection