@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listar Curso</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Curso</li>
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
        <a href="{{ route('admin.curso.add') }}" class="btn btn-success float-right">Cadastrar Curso</a>
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
                  <th>Curso</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($cursoList as $curso)
                    <tr>
                      <td>{{ $curso['codigo'] }}</td>
                      <td>{{ $curso['nome'] }}</td>
                      <td><a href="{{ route('admin.curso.edit', $curso['codigo']) }}">Editar</a> | <a href="{{ route('admin.curso.delete', $curso['codigo']) }}" class="confirmationDeleteAll" class="confirmationDeleteAll"> Excluir</a></td>
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