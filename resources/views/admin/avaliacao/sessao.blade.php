@extends('templates.templateDashboard')

@section('contentDashboard')

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
          <form>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Avaliação sobre a Disciplina do Professor</th>
                  <th scope="col">1</th>
                  <th scope="col">2</th>
                  <th scope="col">3</th>
                  <th scope="col">4</th>
                  <th scope="col">5</th>
                  <th scope="col">6</th>
                  <th scope="col">7</th>
                  <th scope="col">8</th>
                  <th scope="col">9</th>
                  <th scope="col">10</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>O professor mostrou domínio do conteúdo apresentado?</td>
                  <td><input type="radio" value="1" name="1"></td>
                  <td><input type="radio" value="2" name="1"></td>
                  <td><input type="radio" value="3" name="1"></td>
                  <td><input type="radio" value="4" name="1"></td>
                  <td><input type="radio" value="5" name="1"></td>
                  <td><input type="radio" value="6" name="1"></td>
                  <td><input type="radio" value="7" name="1"></td>
                  <td><input type="radio" value="8" name="1"></td>
                  <td><input type="radio" value="9" name="1"></td>
                  <td><input type="radio" value="10" name="1"></td>
                  
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Houve articulação entre teoria e prática do mercado?</td>
                  <td><input type="radio" value="1" value="2"></td>
                  <td><input type="radio" value="2" value="2"></td>
                  <td><input type="radio" value="3" value="2"></td>
                  <td><input type="radio" value="4" value="2"></td>
                  <td><input type="radio" value="5" value="2"></td>
                  <td><input type="radio" value="6" value="2"></td>
                  <td><input type="radio" value="7" value="2"></td>
                  <td><input type="radio" value="8" value="2"></td>
                  <td><input type="radio" value="9" value="2"></td>
                  <td><input type="radio" value="10" value="2"></td>
                      
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>O material apresentado auxiliou no processo de aprendizagem?</td>
                  <td><input type="radio" value="1" value="3"></td>
                  <td><input type="radio" value="2" value="3"></td>
                  <td><input type="radio" value="3" value="3"></td>
                  <td><input type="radio" value="4" value="3"></td>
                  <td><input type="radio" value="5" value="3"></td>
                  <td><input type="radio" value="6" value="3"></td>
                  <td><input type="radio" value="7" value="3"></td>
                  <td><input type="radio" value="8" value="3"></td>
                  <td><input type="radio" value="9" value="3"></td>
                  <td><input type="radio" value="10" value="3"></td>
                      
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>O professor cumpriu a carga horaria integral da disciplina?</td>
                  <td><input type="radio" value="1" value="4"></td>
                  <td><input type="radio" value="2" value="4"></td>
                  <td><input type="radio" value="3" value="4"></td>
                  <td><input type="radio" value="4" value="4"></td>
                  <td><input type="radio" value="5" value="4"></td>
                  <td><input type="radio" value="6" value="4"></td>
                  <td><input type="radio" value="7" value="4"></td>
                  <td><input type="radio" value="8" value="4"></td>
                  <td><input type="radio" value="9" value="4"></td>
                  <td><input type="radio" value="10" value="4"></td>
                      
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>O seu grau de satisfação total da disciplina foi:</td>
                  <td><input type="radio" value="1" value="5"></td>
                  <td><input type="radio" value="2" value="5"></td>
                  <td><input type="radio" value="3" value="5"></td>
                  <td><input type="radio" value="4" value="5"></td>
                  <td><input type="radio" value="5" value="5"></td>
                  <td><input type="radio" value="6" value="5"></td>
                  <td><input type="radio" value="7" value="5"></td>
                  <td><input type="radio" value="8" value="5"></td>
                  <td><input type="radio" value="9" value="5"></td>
                  <td><input type="radio" value="10" value="5"></td>
                      
                </tr>
              </tbody>
            </table>

            <p>Na sua avaliação, o ponto mais <b>estimulante</b> desta disciplina foi:</p>

            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Conteúdo</label>
            </div>

            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck2">
              <label class="form-check-label" for="exampleCheck2">Professor</label>
            </div>

            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck3">
              <label class="form-check-label" for="exampleCheck3">Prática</label>
            </div>

            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck4">
              <label class="form-check-label" for="exampleCheck4">Outros, Quais?</label>
            </div>

            <textarea type="text" class="form-control" aria-describedby="Outros" placeholder="Insira outros motivos"> </textarea>
            <br>
            <button type="button" class="btn btn-success float-right">Finalizar Avaliação</button>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection