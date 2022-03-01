@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Comparar Turmas
            <button class="btn btn-info" id="btnPdf">Baixar PDF</button>
          </h1> 
          
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">

              @if($errors->all())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                    {{ $error }}
                  </div>
                @endforeach
              @endif

            <div class="col-md-6">
              <div class="form-group">
                <label>Curso</label>
                <select class="select2" data-placeholder="Selecione uma opção" name='curso' id='curso' style="width: 100%;" require disabled>
                    <option value="1" selected>{{ $curso->nm_curso }}</option>
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Disciplina</label>
                <select class="select2" data-placeholder="Selecione uma opção" name='disciplina' id='disciplina' style="width: 100%;" require disabled>
                  <option value="1" selected>{{ $disciplina->nm_disciplina }}</option>
                </select>
              </div>
            </div>
            @foreach ($turmas as $i => $turma)
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Turmas {{ $i+1 }}</label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='turma{{ $i+1 }}' id='turma{{ $i+1 }}' style="width: 100%;" require disabled>
                        <option value="1" selected>{{ $turma->nm_turma }}</option>
                    </select>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body hide" id="divChart">
            <input type="hidden" id="urlCanvas" value="{{ route('admin.results.ajaxFilter') }}">
            <input type="hidden" id="idFormulario" value="{{ Request::segment(4) }}">
            <legend><b>Comparar Avaliações</b></legend>
            <br>


            <div class="row">
              <div align="center" class="col-md-5">
                  <span><b>Turma</b> 1</span>
              </div>
              <div align="center" class="col-md-1">
                  <span><b>|</b></span>
              </div>
              <div align="center" class="col-md-5">
                <span><b>Turma</b> 2</span>
              </div>
            </div>

            @foreach ($arrAvaliacoes as $avaliacao)

              <div class="row">
                <div class="col-md-5">
                  <div class="progress-group">
                    {{ $avaliacao['pergunta']->titulo }}

                    @if ($avaliacao['pergunta']->tipo == 'texto')
                    <br><span><b>Resposta: </b>{{ $avaliacao['nota1']->texto }}</span>
                    @else
                      <span class="float-right"><b>Nota: </b>{{ $avaliacao['nota1']->nota }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{ $avaliacao['nota1']->porcentagem }}%"></div>
                      </div>
                    @endif 
                  </div>
                </div>

                <div align="center" class="col-md-1">
                    <span><b>|</b></span><br>
                    <span><b>|</b></span>
                </div>

                <div class="col-md-5">
                  <div class="progress-group">
                    {{ $avaliacao['pergunta']->titulo }}

                    @if ($avaliacao['pergunta']->tipo == 'texto')
                    <br><span><b>Resposta: </b>{{ $avaliacao['nota2']->texto }}</span>
                    @else
                      <span class="float-right"><b>Nota: </b>{{ $avaliacao['nota2']->nota }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{ $avaliacao['nota2']->porcentagem }}%"></div>
                      </div>
                    @endif 
                  </div>
                </div>
              </div>

            @endforeach

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>

@endsection