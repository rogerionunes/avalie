@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Adicionar Sessão</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Sessão</li>
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
                  <label>Cursos</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='curso' style="width: 100%;" require>
                    <option value=""></option>
                    @foreach ($cursos as $cursos)
                      <option value="{{ $cursos->id }}">{{ $cursos->nm_curso }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Turmas</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='turma' style="width: 100%;" require>
                    <option value=""></option>
                    @foreach ($turmas as $turma)
                      <option value="{{ $turma->id }}">{{ $turma->nm_turma }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Disciplina</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='disciplina' style="width: 100%;" require>
                    <option value=""></option>
                    @foreach ($disciplinas as $disciplina)
                      <option value="{{ $disciplina->id }}">{{ $disciplina->nm_disciplina }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Cadastrar Sessão</button>
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