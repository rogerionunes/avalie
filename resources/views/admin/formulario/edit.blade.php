@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Formulário</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Formulario</li>
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
        <form action='{{ route('admin.formulario.editFormulario', Request::segment(4)) }}' method='POST'>
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
                    <option value="{{ $curso->id }}" @if ($formulario->id_curso == $curso->id) selected @endif>{{ $curso->nm_curso }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nome do Formulário</label>
                  <input type="text" class="form-control" name="nome" require value="{{ $formulario->name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Descrição Inicial</label>
                  <textarea class="form-control" rows="3" name="descricao" require> {{ $formulario->descricao }}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-1">
                <div class="form-group">
                  <label>Ordem</label>
                  <input class="form-control" type="number" name='ordem'  id='ordem' value="{{$formulariosPerguntas->count()+1}}" min="1" readonly style="width: 100%;" require>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Bloco</label>
                  <select class="select2" data-placeholder="Selecione o Bloco..." name='bloco' id='bloco' style="width: 100%;" require>
                    <option value="DP">Formulario/Professor</option>
                    <option value="IA">Infraestrutura/Atendimento</option>
                    <option value="O">Outros</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Tipo</label>
                  <select class="select2" data-placeholder="Selecione o Tipo..." name='tipo' id='tipo' style="width: 100%;" require>
                    <option value="notas">Notas</option>
                    <option value="opcoes">Opções</option>
                    <option value="texto">Texto</option>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Titulo Pergunta</label>
                  <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Digite o título da pergunta" require>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label>Adicionar</label>
                  <button type="button" class="form-control btn btn-primary" id="addLista" title="Adicionar item na lista"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label>Remover</label>
                  <button type="button" class="form-control btn btn-primary" id="remLista" title="Remover item da lista"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">Ordem</th>
                    <th width="15%">Tipo</th>
                    <th width="15%">Bloco</th>
                    <th width="60%">Titulo</th>
                  </tr>
                  </thead>
                  <tbody id="tbodyPerguntas">
                    @foreach ($formulariosPerguntas as $pergunta)
                      <tr id="linha{{$pergunta->ordem}}">
                        <td>{{$pergunta->ordem}}</td>
                        <td>{{$pergunta->tipo}}</td>
                        <td>
                          @switch($pergunta->bloco)
                              @case('DP')
                                  Formulário/Professor
                                  @break
                              @case('IA')
                                  Infraestrutura/Atendimento
                                  @break
                              @case('O')
                                  Outros
                                  @break
                          @endswitch
                        </td>
                        <td>{{$pergunta->titulo}}</td>
                        <input type="hidden" name="perguntas[]" class="perguntas" value="{{$pergunta->ordem.'|'.$pergunta->tipo.'|'.$pergunta->bloco.'|'.$pergunta->titulo}}">
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a class="btn btn-danger" href="{{ route('admin.formulario.list') }}">Cancelar</a>
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