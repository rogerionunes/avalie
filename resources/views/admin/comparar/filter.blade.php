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
          <form id="formCompararRel">
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
              <div class="alert alert-danger alert-dismissible" id="divMsgErro" hidden>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                <span id="msgErro"></span>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Curso</label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='curso' id='cursoComparar' style="width: 100%;" require>
                      <option value=""></option>
                      @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nm_curso }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Disciplinas </label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='disciplina' id='disciplinaComparar' require disabled >
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Turmas <span style="color:red;font-size: 9px;">(mínimo - 2 | máximo - 3)</span></label>
                    <select class="select2" data-placeholder="Selecione uma opção" name='turma[]' id='turmaComparar' style="width: 100%;" require disabled multiple>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-success" id="btnGerarRelComparar">Gerar Relatório</button>
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

@endsection