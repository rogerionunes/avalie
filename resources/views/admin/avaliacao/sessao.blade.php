@extends('templates.templateDashboard')

@section('contentDashboard')
  <style>
    td:hover {
      opacity: 1.0;
    }
  </style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 text-center" >
          <h1>Avaliação</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
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

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-body">
        <p>Caro(a) Aluno(a)</p>
        <p>Solicitamos sua opnião em cada um dos itens abaixo para que possamos avaliar a disciplina e aplicar as melhorias contínuas que se fizerem necessárias para melhoria do processo de ensino e aprendizagem, bem como da qualidade deste curso.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-body">
          <form action="{{ route('admin.avaliacao.addSessao', 'pin='.app('request')->input('pin')) }}" method='POST'>
          @csrf

            @foreach ([$listPerguntasDP, $listPerguntasIA] as $list)
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col" align="center">#</th>
                    <th scope="col" width="50%">
                        Avaliação sobre a 
                        @if ($list[0]->bloco == 'DP') 
                          Disciplina e Professor 
                        @else 
                          Instituição e Atendimento 
                        @endif
                    </th>
                    <th scope="col" align="center">1</th>
                    <th scope="col" align="center">2</th>
                    <th scope="col" align="center">3</th>
                    <th scope="col" align="center">4</th>
                    <th scope="col" align="center">5</th>
                    <th scope="col" align="center">6</th>
                    <th scope="col" align="center">7</th>
                    <th scope="col" align="center">8</th>
                    <th scope="col" align="center">9</th>
                    <th scope="col" align="center">10</th>
                  </tr>
                </thead>
                
                <tbody>
                    @foreach ($list as $pergunta)
                      <tr>
                          <th scope="row" align="center">{{$pergunta->ordem}}</th>
                          <td>{{$pergunta->titulo}}?</td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;" class="fieldsForms" type="radio" value="1" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="2" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="3" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="4" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="5" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="6" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="7" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="8" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="9" name="pergunta_{{$pergunta->ordem}}"></td>
                          <td align="center" style="cursor: pointer;"><input style="cursor: pointer;"class="fieldsForms" type="radio" value="10" name="pergunta_{{$pergunta->ordem}}"></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            @endforeach

            @foreach ($listPerguntasO as $pergunta)
              <p>{{$pergunta->ordem.' - '.$pergunta->titulo}}?</p>

              <textarea type="text" class="form-control fieldText" aria-describedby="Outros" name="pergunta_{{$pergunta->id}}" placeholder="Escreva a resposta aqui"></textarea>
            @endforeach

            <br>

            <button type="button" class="btn btn-success float-right" id="btnFinalizarAvaliacao">Finalizar Avaliação</button>

          </form>
        </div>
      </div>
    </div>
  </section>

@endsection