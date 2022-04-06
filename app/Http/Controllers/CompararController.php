<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
use App\Models\AvaliacoesNotas;
use App\Models\Cursos;
use App\Models\Disciplinas;
use App\Models\Formularios;
use App\Models\Turmas;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompararController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.comparar.filter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $disciplinas = DB::table('disciplinas')->where('id_professor', Auth::user()->id)->get();
        
        $turmas = [];
        $cursos = [];

        foreach ($disciplinas as $disciplina) {
            $turma = DB::table('turmas')->find($disciplina->id_turma);
            $turmas[$turma->id] = $turma;
        }
        
        foreach ($turmas as $turma) {
            $curso = DB::table('cursos')->find($turma->id_curso);
            $cursos[$curso->id] = $curso;
        }

        return view('admin.comparar.filter', [
            'cursos' => DB::table('cursos')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function relatorio($cursoId, $turmasIds, $disciplinaId)
    {
        $cursoId = $cursoId;
        $turmasIds = $turmasIds;
        $disciplinaId = $disciplinaId;
        
        $curso = DB::table('cursos')->find($cursoId);

        if (!$curso) {
            return redirect()->back()->withInput()->withErrors(['Curso não existente ']);
        }

        $disciplina = DB::table('disciplinas')->find($disciplinaId);

        if (!$disciplina) {
            return redirect()->back()->withInput()->withErrors(['Disciplina não existente ']);
        }

        $turmas = explode(',', $turmasIds);
        $turmaAux = [];

        foreach ($turmas as $turma) {
            $turmaAux[] = DB::table('turmas')->find($turma);
        }
        dd($turmas);
        $avaliacaoTurma1 = DB::table('avaliacoes')->where(['id_turma' => $turmas[0], 'id_curso' => $cursoId, 'id_disciplina' => $disciplinaId, 'status' => '1'])->first();
        
        if (!$avaliacaoTurma1) {
            return redirect()->back()->withInput()->withErrors(['A Turma não possui avaliação criada']);
        }

        $avaliacaoTurma1->notas = DB::table('avaliacoes_notas')->where(['avaliacao_id' => $avaliacaoTurma1->id])->get();

        if (!$avaliacaoTurma1->notas) {
            return redirect()->back()->withInput()->withErrors(['A Turma  não possui avaliação respondida ']);
        }
        
        $avaliacaoTurma2 = DB::table('avaliacoes')->where(['id_turma' => $turmas[1], 'id_curso' => $cursoId, 'id_disciplina' => $disciplinaId, 'status' => '1'])->first();
        
        if (!$avaliacaoTurma2) {
            return redirect()->back()->withInput()->withErrors(['A Turma não possui avaliação criada: ']);
        }
        
        $avaliacaoTurma2->notas = DB::table('avaliacoes_notas')->where(['avaliacao_id' => $avaliacaoTurma2->id])->get();

        if (!$avaliacaoTurma2->notas) {
            return redirect()->back()->withInput()->withErrors(['A Turma  não possui avaliação respondida ']);
        }
        
        $arrAvaliacoes = [];
        // pergunta 1
        // qtde nota 1
        // qtde nota 2
        // qtde nota 3 (...)
        
        foreach ($avaliacaoTurma1->notas as $nota1) {
            $pergunta = DB::table('formularios_perguntas')->find($nota1->pergunta_id);
                
            $arrAvaliacoes[$nota1->pergunta_id]['pergunta'] = $pergunta;

            if (!isset($arrAvaliacoes[$nota1->pergunta_id]['qtdeTotal1'])) {
                $arrAvaliacoes[$nota1->pergunta_id]['qtdeTotal1'] = 0;
            }

            $arrAvaliacoes[$nota1->pergunta_id]['qtdeTotal1'] += 1;
                
            if ($nota1->nota >= '0') {

                if (!isset($arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][$nota1->nota]['qtde1'])) {
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][0]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][1]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][2]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][3]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][4]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][5]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][6]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][7]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][8]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][9]['qtde1'] = 0;
                    $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][10]['qtde1'] = 0;
                }
            
                $arrAvaliacoes[$nota1->pergunta_id]['avaliacoes'][$nota1->nota]['qtde1'] += 1;
            } else {
                $arrAvaliacoes[$nota1->pergunta_id]['respostas1'][] = $nota1->texto;
            }
        }
        
        foreach ($avaliacaoTurma2->notas as $nota2) {
            $pergunta = DB::table('formularios_perguntas')->find($nota2->pergunta_id);
                
            $arrAvaliacoes[$nota2->pergunta_id]['pergunta'] = $pergunta;

            if (!isset($arrAvaliacoes[$nota1->pergunta_id]['qtdeTotal2'])) {
                $arrAvaliacoes[$nota2->pergunta_id]['qtdeTotal2'] = 0;
            }
            
            $arrAvaliacoes[$nota2->pergunta_id]['qtdeTotal2'] += 1;
                
            if ($nota2->nota >= '0') {

                if (!isset($arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][$nota2->nota]['qtde2'])) {
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][0]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][1]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][2]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][3]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][4]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][5]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][6]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][7]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][8]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][9]['qtde2'] = 0;
                    $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][10]['qtde2'] = 0;
                }

                $arrAvaliacoes[$nota2->pergunta_id]['avaliacoes'][$nota2->nota]['qtde2'] += 1;
            } else {
                $arrAvaliacoes[$nota2->pergunta_id]['respostas2'][] = $nota2->texto;
            }
        }
        
        return view('admin.comparar.rel', [
            'curso' => $curso,
            'disciplina' => $disciplina,
            'turmas' => $turmaAux,
            'arrAvaliacoes' => $arrAvaliacoes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSessao(Request $request)
    {
        $comparar = Avaliacoes::where([['pin', $request->pin],['status', '1']])->first();

        $formulariosPerguntas = $comparar->curso->formularios->formulariosPerguntas;

        DB::beginTransaction();

        foreach ($formulariosPerguntas as $pergunta) {

            $pergunta_id = 'pergunta_'.$pergunta->id;
            $nota = is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;
            $texto = !is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;

            try {
                AvaliacoesNotas::create([
                    'comparar_id' => $comparar->id,
                    'pergunta_id' => $pergunta->id,
                    'nota' => $nota,
                    'texto' => $texto,
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withInput()->withErrors(['Erro ao salvar perguntas: '.$e->getMessage()]);
            }
        }

        DB::commit();

        return redirect()->route('/');
    }
    
    public function sessao(Request $request)
    {
        
        $pin = preg_replace('/[^A-Za-z0-9]/', "", $request->pin);

        $comparar = DB::table('avaliacoes')->where(['pin' => $pin])->first();

        if ($comparar) {

            if ($comparar->status == '0') {
                return redirect()->back()->withInput()->withErrors(['Sessão expirada.']);
            }

            $curso = Cursos::find($comparar->id_curso);
            $turma = DB::table('turmas')->find($comparar->id_turma);
            $disciplina = DB::table('disciplinas')->find($comparar->id_disciplina);
            $professor = DB::table('users')->find($comparar->id_professor);
            $formularios = $curso->formularios->where('ativo', '1')->first();
            $formulariosPerguntas = $formularios->formulariosPerguntas;

            $listPerguntasDP = [];
            $listPerguntasIA = [];
            $listPerguntasO = [];

            foreach ($formulariosPerguntas as $pergunta) {
                switch ($pergunta->bloco) {
                    case 'DP':
                        $listPerguntasDP[] = $pergunta;
                        break;
                    case 'IA':
                        $listPerguntasIA[] = $pergunta;
                        break;
                    case 'O':
                        $listPerguntasO[] = $pergunta;
                        break;
                }
            }

            return view('admin.comparar.sessao', [
                'disciplina' => $disciplina,
                'curso' => $curso,
                'turma' => $turma,
                'professor' => $professor,
                'formularios' => $formularios,
                'listPerguntasDP' => $listPerguntasDP,
                'listPerguntasIA' => $listPerguntasIA,
                'listPerguntasO' => $listPerguntasO,
            ]);

        }

        return redirect()->back()->withInput()->withErrors(['PIN incorreto, digite novamente.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listDisciplina(Request $request)
    {   
        $turmas = DB::table('turmas')->where('id_curso', $request->idCurso)->get();
        $turmaAux = [];

        foreach ($turmas as $turma) {

            $disciplinas = DB::table('turmas_disciplinas')->where('turma_id', $turma->id)->get();
            
            foreach ($disciplinas as $disciplina) {
                $disc = DB::table('disciplinas')->find($disciplina->disciplina_id);

                if (in_array(Auth::user()->tp_usuario, ['S','C']) || $disc->id_professor == Auth::user()->id) {
                    $discAux[$disc->id] = $disc;
                }
            }
        }

        if ($discAux) {
            $response = ['status' => '1', 'dados' => $discAux];
        } else {
            $response = ['status' => '0', 'dados' => []];
        }

        return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTurma(Request $request)
    {
        $turmasDisciplinas = DB::table('turmas_disciplinas')->where('disciplina_id', $request->idDisciplina)->get();

        $turmaAux = [];

        foreach ($turmasDisciplinas as $turmasDisciplina) {
            $turma = DB::table('turmas')->find($turmasDisciplina->turma_id);

            $turmaAux[$turma->id] = $turma;
        }

        if ($turmaAux) {
            $response = ['status' => '1', 'dados' => $turmaAux];
        } else {
            $response = ['status' => '0', 'dados' => []];
        }

        return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //valida se campos estao preenchidos
        $campos = ['turma' => 'Turma', 'curso' => 'Curso', 'disciplina' => 'Disciplina'];

        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return json_encode(['status' => '0', 'erro' => 'O campo '.$campo.' é obrigatório.']);
            }
        }

        //gera pin diferente dos pins ativos
        $listaPins = array_map(function($value) {
            return $value->pin;
        }, DB::table('avaliacoes')->where('status', '1')->get()->toArray());

        $pin = $this->geraPin();

        while (in_array($pin, $listaPins)) {
            $pin = $this->geraPin();
        }

        //insercao da comparar
        $comparar = Avaliacoes::firstOrcreate(['id_professor' => Auth::user()->id, 
            'id_curso' => $request->curso,
            'id_turma' => $request->turma,
            'id_disciplina' => $request->disciplina,
            'status' => '1',
        ], [
        'pin' => $this->geraPin(),
        'dataValidade' => date('Y-m-d H:i:s', strtotime('now+1day')),
        ]);

        if ($comparar) {
            if (!$comparar->wasRecentlyCreated) {
                return json_encode(['status' => '0', 'erro' => 'já possui uma avaliação ativa para esse curso, turma e disciplina.']);
            }
            return json_encode(['status' => '1']);
        }

        return json_encode(['status' => '0', 'erro' => 'Ocorreu algum erro ao cadastrar comparar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizar($id)
    {
        $comparar = DB::table('avaliacoes')
              ->where('id', $id)
              ->update(['status' => '0']);

        if ($comparar) {
            return redirect()->route('admin.comparar.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao finalizar a comparar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function geraPin()
    {
        $pinCompleto = array();
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
        $numbers = "0123456789";
        for ($i = 0; $i < 6; $i++) {
            if ($i < 3) {
                $pin = $alphabet[rand(0, strlen($alphabet) - 1)];
            } else {
                $pin = $numbers[rand(0, strlen($numbers) - 1)];
            }
            $pinCompleto[] = $pin;
        }


        return implode($pinCompleto);
    }
}
