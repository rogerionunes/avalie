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
        $compararList = [];
        $avaliacoes = DB::table('avaliacoes');

        return view('admin.comparar.filter');
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
