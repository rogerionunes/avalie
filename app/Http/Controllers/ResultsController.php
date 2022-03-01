<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
use App\Models\AvaliacoesNotas;
use App\Models\Cursos;
use App\Models\Disciplinas;
use App\Models\Formularios;
use App\Models\Turmas;
use App\Models\Users;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResultsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.results.filter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $id = $request->id;

        $avaliacao = Avaliacoes::find($id);
        if ($avaliacao) {
            
            $curso = Cursos::find($avaliacao->id_curso);
            $turma = DB::table('turmas')->find($avaliacao->id_turma);
            $disciplina = DB::table('disciplinas')->find($avaliacao->id_disciplina);
            $professor = DB::table('users')->find($avaliacao->id_professor);
            $formularios = $curso->formularios->where('ativo', '1')->first();
            $formulariosPerguntas = $formularios->formulariosPerguntas;

            $perguntasRespostas = [];

            foreach ($avaliacao->avaliacaoNotas as $avaliacaoNota) {
                $perguntasRespostas[$avaliacaoNota->pergunta_id][] = isset($avaliacaoNota->nota)?$avaliacaoNota->nota:$avaliacaoNota->texto;
            }

            $listPerguntasO = [];
            $listPerguntasDP = [];
            $listPerguntasIA = [];
            
            foreach ($formulariosPerguntas as $pergunta) {
                
                if ($pergunta->bloco == 'O') {
                    $pergunta->respostas = $perguntasRespostas[$pergunta->id];
                    $listPerguntasO[] = $pergunta;
                } else if ($pergunta->bloco == 'DP') {
                    if (isset($perguntasRespostas[$pergunta->id])) {
                        $listPerguntasDP[] = $pergunta;
                    }
                } else if ($pergunta->bloco == 'IA') {
                    if (isset($perguntasRespostas[$pergunta->id])) {
                        $listPerguntasIA[] = $pergunta;
                    }
                }
            }
            
            $dados = [
                'disciplina' => $disciplina,
                'curso' => $curso,
                'turma' => $turma,
                'professor' => $professor,
                'formularios' => $formularios,
                'listPerguntasO' => $listPerguntasO,
                'listPerguntasDP' => $listPerguntasDP,
                'listPerguntasIA' => $listPerguntasIA,
                'download' => isset($request->download),
            ];
            return view('admin.results.filter', $dados);
        }

        return view('admin.results.filter');
    }

    public function ajaxFilter(Request $request) {
        
        $avaliacao = Avaliacoes::find($request->idFormulario);
        
        if ($avaliacao) {
            
            $curso = Cursos::find($avaliacao->id_curso);
            $formularios = $curso->formularios->where('ativo', '1')->first();
            $formulariosPerguntas = $formularios->formulariosPerguntas;

            $perguntasRespostas = [];

            foreach ($avaliacao->avaliacaoNotas as $avaliacaoNota) {

                switch ($avaliacaoNota->nota) {
                    case '0':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['0'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['0'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['0']+1:1;
                        break;
                    case '1':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['1'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['1'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['1']+1:1;
                        break;
                    case '2':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['2'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['2'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['2']+1:1;
                        break;
                    case '3':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['3'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['3'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['3']+1:1;
                        break;
                    case '4':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['4'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['4'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['4']+1:1;
                        break;
                    case '5':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['5'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['5'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['5']+1:1;
                        break;
                    case '6':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['6'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['6'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['6']+1:1;
                        break;
                    case '7':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['7'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['7'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['7']+1:1;
                        break;
                    case '8':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['8'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['8'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['8']+1:1;
                        break;
                    case '9':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['9'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['9'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['9']+1:1;
                        break;
                    case '10':
                        $perguntasRespostas[$avaliacaoNota->pergunta_id]['10'] = isset($perguntasRespostas[$avaliacaoNota->pergunta_id]['10'])?$perguntasRespostas[$avaliacaoNota->pergunta_id]['10']+1:1;
                        break;
                    default:
                        $perguntasRespostas[$avaliacaoNota->pergunta_id][] = $avaliacaoNota->texto;
                        break;
                }
            }

            $listPerguntasTexto = [];
            $listPerguntas = [];
            
            foreach ($formulariosPerguntas as $pergunta) {
                
                if ($pergunta->bloco == '0') {
                    $listPerguntasTexto[] = [
                        'pergunta' => $pergunta->titulo,
                        'respostas' => $perguntasRespostas[$pergunta->id],
                    ];
                } else {
                    if (isset($perguntasRespostas[$pergunta->id]) && count($perguntasRespostas[$pergunta->id]) > 0) {
                        $pergunta->notas = [
                            'labels' => array_keys($perguntasRespostas[$pergunta->id]),
                            'data' => array_values($perguntasRespostas[$pergunta->id]),
                        ];
                        $listPerguntas[] = $pergunta;
                    }
                }
            }

            $dados = [
                'listPerguntas' => $listPerguntas,
                'listPerguntasTexto' => $listPerguntasTexto,
            ];

            $response = ['status' => '1', 'dados' => $dados];
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
    public function addSessao(Request $request)
    {
        $results = Avaliacoes::where([['pin', $request->pin],['status', '1']])->first();

        $formulariosPerguntas = $results->curso->formularios->formulariosPerguntas;

        DB::beginTransaction();

        foreach ($formulariosPerguntas as $pergunta) {

            $pergunta_id = 'pergunta_'.$pergunta->id;
            $nota = is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;
            $texto = !is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;

            try {
                AvaliacoesNotas::create([
                    'results_id' => $results->id,
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

        $results = DB::table('avaliacoes')->where(['pin' => $pin])->first();

        if ($results) {

            if ($results->status == '0') {
                return redirect()->back()->withInput()->withErrors(['Sessão expirada.']);
            }

            $curso = Cursos::find($results->id_curso);
            $turma = DB::table('turmas')->find($results->id_turma);
            $disciplina = DB::table('disciplinas')->find($results->id_disciplina);
            $professor = DB::table('users')->find($results->id_professor);
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

            return view('admin.results.sessao', [
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
    public function listTurma(Request $request)
    {
        $turmas = DB::table('turmas')->where('id_curso', $request->idCurso)->get();
        $turmaAux = [];

        foreach ($turmas as $turma) {

            $disciplinas = DB::table('disciplinas')->where('id_turma', $turma->id)->get();

            foreach ($disciplinas as $disciplina) {
                if ($disciplina->id_professor == Auth::user()->id) {
                    $turmaAux[$turma->id] = $turma;
                }
            }
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
    public function listDisciplina(Request $request)
    {
        $disciplinas = DB::table('disciplinas')->where(['id_turma' => $request->idTurma, 'id_professor' => Auth::user()->id])->get();

        if ($disciplinas) {
            $response = ['status' => '1', 'dados' => $disciplinas];
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

        //insercao da results
        $results = Avaliacoes::firstOrcreate(['id_professor' => Auth::user()->id, 
            'id_curso' => $request->curso,
            'id_turma' => $request->turma,
            'id_disciplina' => $request->disciplina,
            'status' => '1',
        ], [
        'pin' => $this->geraPin(),
        'dataValidade' => date('Y-m-d H:i:s', strtotime('now+1day')),
        ]);

        if ($results) {
            if (!$results->wasRecentlyCreated) {
                return json_encode(['status' => '0', 'erro' => 'já possui uma avaliação ativa para esse curso, turma e disciplina.']);
            }
            return json_encode(['status' => '1']);
        }

        return json_encode(['status' => '0', 'erro' => 'Ocorreu algum erro ao cadastrar results']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizar($id)
    {
        $results = DB::table('avaliacoes')
              ->where('id', $id)
              ->update(['status' => '0']);

        if ($results) {
            return redirect()->route('admin.results.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao finalizar a results']);
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
