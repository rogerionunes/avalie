@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Avaliação</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Avaliação</li>
              <li class="breadcrumb-item active">Editar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
          <form action='{{ route('admin.users.editUser', Request::segment(4)) }}' method='POST'>
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
                  <input type="text" class="form-control" name="nome" value='{{ $user->name }}' placeholder="Digite o Nome" require>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value='{{ $user->email }}' placeholder="Digite o Email" require>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Senha</label>
                  <input type="password" class="form-control" name="senha" placeholder="Digite a Senha">
                </div>
                <div class="form-group">
                  <label>Tipo de Avaliação</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='tipoAvaliacao' style="width: 100%;" placeholder="Selecione uma Opção" require>
                    <option value=''></option>
                    <option value='P' @if ($user->tp_avaliacao == 'P') selected @endif>Professor</option>
                    <option value='C' @if ($user->tp_avaliacao == 'C') selected @endif>Coordenador</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Editar Avaliação</button>
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