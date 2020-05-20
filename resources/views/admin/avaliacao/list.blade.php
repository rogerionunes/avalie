@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Avaliação</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active">Avaliação</li>
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

            

            <div id="blocoCadastro">
              <div class="alert alert-danger alert-dismissible" id="divMsgErro">
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
                <button type="button" class="btn btn-success" id="btnIniciarAvaliacao">Iniciar Avaliação</button>
                <button type="button" class="btn btn-danger" id="btnCancelar">Cancelar</button>
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
                  <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($avaliacaoList as $avaliacao)
                    <tr>
                      <td>{{ $avaliacao['codigo'] }}</td>
                      <td>{{ $avaliacao['professor'] }}</td>
                      <td>{{ $avaliacao['data'] }}</td>
                      <td>{{ $avaliacao['curso'] }}</td>
                      <td>{{ $avaliacao['turma'] }}</td>
                      <td>{{ $avaliacao['disciplina'] }}</td>
                      <td>{{ $avaliacao['pin'] }}</td>
                      <td>
                        @if ($avaliacao['status'] == '1')
                          <a class="btn btn-success" style="color:white">Andamento</a>
                        @else
                          <a class="btn btn-danger" style="color:white">Finalizado</a>
                        @endif 
                      </td>
                      <td>
                        @if ($avaliacao['status'] == '1')
                          <a class="confirmationFinalizar" href="{{ route('admin.avaliacao.finalizar', $avaliacao['codigo']) }}">Finalizar</a></td>
                        @else
                        -
                        @endif 
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