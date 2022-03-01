@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Turma</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Turma</li>
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
          <form action='{{ route('admin.turma.editTurma', Request::segment(4)) }}' method='POST'>
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
                    @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}"@if ($turma->id_curso == $curso->id) selected @endif>{{ $curso->nm_curso }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="nome" require value="{{ $turma->nm_turma }}">
                </div>

                <div class="form-group">
                  <label>Ano</label>
                  <input type="number" class="form-control" name="ano" require value="{{ $turma->ano }}">
                </div>

                <div class="form-group">
                  <label>Semestre</label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="1semestre" name="semestre" value='1' @if ($turma->semestre == '1') checked @endif>
                    <label for="1semestre">1° Semestre</label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="2semestre" name="semestre" value='2' @if ($turma->semestre == '2') checked @endif>
                    <label for="2semestre">2° Semestre</label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Turno</label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="turnoM" name="turno" value='M' @if ($turma->turno == 'M') checked @endif>
                    <label for="turnoM">Manhã</label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="turnoT" name="turno" value='T' @if ($turma->turno == 'T') checked @endif>
                    <label for="turnoT">Tarde</label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="turnoN" name="turno" value='N' @if ($turma->turno == 'N') checked @endif>
                    <label for="turnoN">Noite</label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Disciplinas</label>
                  <select class="select2Simple" data-placeholder="Selecione uma opção" name='disciplinas[]' style="width: 100%;" require multiple>
                    <option value=""></option>
                    @foreach ($disciplinas as $disciplina)
                      <option value="{{ $disciplina->id }}" @if (in_array($disciplina->id, $turmasDisciplinas)) selected @endif>{{ $disciplina->nm_disciplina }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Editar Turma</button>
                <a class="btn btn-danger" href="{{ route('admin.turma.list') }}">Cancelar</a>
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