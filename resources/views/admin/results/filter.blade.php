@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Resultado da Avaliação
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

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Professor</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='professor' id='professor' style="width: 100%;" require disabled>
                      <option value="1" selected>{{ $professor->name }}</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Curso</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='curso' id='curso' style="width: 100%;" require disabled>
                      <option value="1" selected>{{ $curso->nm_curso }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Turma</label>
                  <select class="select2" data-placeholder="Selecione uma opção" name='turma' id='turma' style="width: 100%;" require disabled>
                      <option value="1" selected>{{ $turma->nm_turma }}</option>
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
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body" id="divCarregando">
            Carregando . . . 
          </div>
          <div class="card-body hide" id="divDonuts">
            <input type="hidden" id="urlCanvas" value="{{ route('admin.results.ajaxFilter') }}">
            <input type="hidden" id="idFormulario" value="{{ Request::segment(4) }}">
            <legend><b>Avaliação sobre a Disciplina e Professor</b></legend>
            <br>
            <div class="row">
              @foreach ($listPerguntasDP as $i => $pergunta)
                
              <div class="col-md-3">
                <label>{{ $i+1 . ' - ' . $pergunta->titulo }}</label>
                <canvas class="donutChart{{ $pergunta->id }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>

              @endforeach
            </div>
            <br>
            <legend><b>Avaliação sobre a Instituição e Atendimento</b></legend>
            <br>
            <div class="row">
              @foreach ($listPerguntasIA as $i => $pergunta)
                
              <div class="col-md-3">
                <label>{{ $i+1 . ' - ' . $pergunta->titulo }}</label>
                <canvas class="donutChart{{ $pergunta->id }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>

              @endforeach
            </div>
            <br>
            @foreach ($listPerguntasO as $pergunta)
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <th>{{ $pergunta->titulo }} </th>
                      <tbody>
                        @foreach ($pergunta->respostas as $i => $respostas)
                          <tr><th>{{ $i+1 . ' - ' . $respostas }}</tr>
                        @endforeach
                      </tbody>
                    </table>
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