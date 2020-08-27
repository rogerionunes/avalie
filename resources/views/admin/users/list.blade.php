@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listar Usuários</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Usuário</li>
              <li class="breadcrumb-item active">Listar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <a href="{{ route('admin.users.add') }}" class="btn btn-success float-right">Cadastrar Usuário</a>
      </div>
    </div>
    <br>

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
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Usuário</th>
                  <th>Email</th>
                  <th>Tipo de Usuário</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($usersList as $user)
                    <tr>
                      <td>{{ $user['codigo'] }}</td>
                      <td>{{ $user['usuario'] }}</td>
                      <td>{{ $user['email'] }}</td>
                      <td>{{ $user['tipoUsuario'] }}</td>
                      <td><a href="{{ route('admin.users.edit', $user['codigo']) }}">Editar</a> | <a href="{{ route('admin.users.delete', $user['codigo']) }}">Delete</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
    
@endsection