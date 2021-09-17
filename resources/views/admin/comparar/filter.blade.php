@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comparar Avaliações</h1>
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

            <div id="blocoCadastro" hidden>
              <div class="alert alert-danger alert-dismissible" id="divMsgErro" hidden>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                <span id="msgErro"></span>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cursos</label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='curso' id='curso' style="width: 100%;" require>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Turmas</label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='turma' id='turma' style="width: 100%;" require disabled>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='disciplina' id='disciplina' style="width: 100%;" require disabled>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-success" id="btnCadastrar">Cadastrar Avaliação</button>
                <button type="button" class="btn btn-success" id="btnIniciarAvaliacao" hidden>Iniciar Avaliação</button>
                <button type="button" class="btn btn-danger" id="btnCancelar" hidden>Cancelar</button>
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

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Professor</th>
                  <th>Data</th>
                  <th>Curso</th>
                  <th>Turma</th>
                  <th>Disciplina</th>
                  <th>PIN</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
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