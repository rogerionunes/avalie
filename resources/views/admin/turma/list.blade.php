@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listar Turma</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Turma</li>
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
        <a href="{{ route('admin.turma.add') }}" class="btn btn-success float-right">Cadastrar Turma</a>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Curso</th>
                  <th>Turma</th>
                  <th>Ano</th>
                  <th>Semestre</th>
                  <th>Turno</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($turmaList as $turma)
                    <tr>
                      <td>{{ $turma['codigo'] }}</td>
                      <td>{{ $turma['curso'] }}</td>
                      <td>{{ $turma['nome'] }}</td>
                      <td>{{ $turma['ano'] }}</td>
                      <td>{{ $turma['semestre'] }}</td>
                      <td>{{ $turma['turno'] }}</td>
                      <td>{{ $turma['status'] }}</td>
                      <td><a href="{{ route('admin.turma.edit', $turma['codigo']) }}">Editar</a> | <a href="{{ route('admin.turma.delete', $turma['codigo']) }}">Delete</a></td>
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