@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listar Disciplina</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Disciplina</li>
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
        <a href="{{ route('admin.disciplina.add') }}" class="btn btn-success float-right">Cadastrar Disciplina</a>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Turma</th>
                  <th>Professor</th>
                  <th>Disciplina</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($disciplinaList as $disciplina)
                    <tr>
                      <td>{{ $disciplina['codigo'] }}</td>
                      <td>{{ $disciplina['turma'] }}</td>
                      <td>{{ $disciplina['professor'] }}</td>
                      <td>{{ $disciplina['nome'] }}</td>
                      <td><a href="{{ route('admin.disciplina.edit', $disciplina['codigo']) }}">Editar</a> | <a href="{{ route('admin.disciplina.delete', $disciplina['codigo']) }}">Delete</a></td>
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