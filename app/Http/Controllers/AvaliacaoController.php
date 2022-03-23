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

class AvaliacaoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.avaliacao.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $avaliacaoList = [];
        $avaliacoes = DB::table('avaliacoes');
        
        if (!in_array(Auth::user()->tp_usuario, ['S','C'])) {
            $avaliacoes->where('id_professor', Auth::user()->id);
        }
        
        $avaliacoes = $avaliacoes->orderBy('status', 'desc')->orderBy('id', 'desc')->get();
        
        foreach ($avaliacoes as $avaliacao) {
        
            $qtdeAvaliacoes = DB::table('avaliacoes_notas')->where('avaliacao_id', $avaliacao)->count();
            
            $avaliacaoList[] = [
                'codigo' => $avaliacao->id,
                'professor' => Users::find($avaliacao->id_professor)->name,
                'curso' => Cursos::find($avaliacao->id_curso)->nm_curso,
                'turma' => Turmas::find($avaliacao->id_turma)->nm_turma,
                'disciplina' => Disciplinas::find($avaliacao->id_disciplina)->nm_disciplina,
                'pin' => $avaliacao->pin,
                'data' => date('d/m/Y h:i:00', strtotime($avaliacao->created_at)),
                'status' => $avaliacao->status,
                'qtdeAvaliacoes' => $qtdeAvaliacoes,
                'resultados' => AvaliacoesNotas::where('avaliacao_id', $avaliacao->id)->count() > 0,
            ];
        }
        
        
        if (!in_array(Auth::user()->tp_usuario, ['S','C'])) {
            $disciplinas = DB::table('disciplinas')->where('id_professor', Auth::user()->id)->get();
        } else {
            $disciplinas = DB::table('disciplinas')->get();
        }
        
        $turmas = [];
        $cursos = [];

        foreach ($disciplinas as $disciplina) {
            $turmasDisciplinas = DB::table('turmas_disciplinas')->where('disciplina_id', $disciplina->id)->get();

            
            foreach ($turmasDisciplinas as $turmasDisciplina) {
                $turma = DB::table('turmas')->find($turmasDisciplina->turma_id);
                $turmas[$turma->id] = $turma;
            }
        }
        
        foreach ($turmas as $turma) {
            $curso = DB::table('cursos')->find($turma->id_curso);
            $cursos[$curso->id] = $curso;
        }

        return view('admin.avaliacao.list', [
            'disciplinas' => $disciplinas,
            'turmas' => $turmas,
            'cursos' => $cursos,
            'avaliacaoList' => $avaliacaoList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSessao(Request $request)
    {
        $avaliacao = Avaliacoes::where([['pin', $request->pin],['status', '1']])->first();

        $formulariosPerguntas = $avaliacao->curso->formularios->formulariosPerguntas;

        DB::beginTransaction();

        foreach ($formulariosPerguntas as $pergunta) {

            $pergunta_id = 'pergunta_'.$pergunta->id;
            $nota = is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;
            $texto = !is_numeric($request->$pergunta_id) ? $request->$pergunta_id : null;

            try {
                AvaliacoesNotas::create([
                    'avaliacao_id' => $avaliacao->id,
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

        $avaliacao = DB::table('avaliacoes')->where(['pin' => $pin])->first();

        if ($avaliacao) {

            if ($avaliacao->status == '0') {
                return redirect()->back()->withInput()->withErrors(['Sessão expirada.']);
            }

            $curso = Cursos::find($avaliacao->id_curso);
            $turma = DB::table('turmas')->find($avaliacao->id_turma);
            $disciplina = DB::table('disciplinas')->find($avaliacao->id_disciplina);
            $professor = DB::table('users')->find($avaliacao->id_professor);
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

            return view('admin.avaliacao.sessao', [
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

            $turmasDisciplinas = DB::table('turmas_disciplinas')->where('turma_id', $turma->id)->get();
            
            foreach ($turmasDisciplinas as $turmaDisciplina) {
                $disciplina = DB::table('disciplinas')->find($turmaDisciplina->disciplina_id);

                if (Auth::user()->tp_usuario != 'C') {
                    if ($disciplina->id_professor != Auth::user()->id && Auth::user()->tp_usuario == 'P') {
                        continue;
                    }
                }
                $turmaAux[$turma->id] = $turma;
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
        $where = [];
        $disciplinasAux = [];
        
        $turmasDisciplinas = DB::table('turmas_disciplinas')->where(['turma_id' => $request->idTurma])->get();
        foreach ($turmasDisciplinas as $turmaDisciplina) {

            if (Auth::user()->tp_usuario == 'P') {
                $where['id_professor'] = Auth::user()->id; 
            }
            
            $where['id'] = $turmaDisciplina->disciplina_id;
            
            $disciplina =  DB::table('disciplinas')->where($where)->first();

            if ($disciplina) {
                $disciplinasAux[$disciplina->id] = $disciplina;
            }

        }

        // $disciplinas = DB::table('disciplinas')->where($where)->get();

        if ($disciplinasAux) {
            $response = ['status' => '1', 'dados' => $disciplinasAux];
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

        //insercao da avaliacao
        $avaliacao = Avaliacoes::firstOrcreate(['id_professor' => Auth::user()->id, 
            'id_curso' => $request->curso,
            'id_turma' => $request->turma,
            'id_disciplina' => $request->disciplina,
            'status' => '1',
        ], [
        'pin' => $this->geraPin(),
        'dataValidade' => date('Y-m-d H:i:s', strtotime('now+1day')),
        ]);

        if ($avaliacao) {
            if (!$avaliacao->wasRecentlyCreated) {
                return json_encode(['status' => '0', 'erro' => 'já possui uma avaliação ativa para esse curso, turma e disciplina.']);
            }
            return json_encode(['status' => '1']);
        }

        return json_encode(['status' => '0', 'erro' => 'Ocorreu algum erro ao cadastrar avaliacao']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizar($id)
    {
        $avaliacao = DB::table('avaliacoes')
              ->where('id', $id)
              ->update(['status' => '0']);

        if ($avaliacao) {
            return redirect()->route('admin.avaliacao.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao finalizar a avaliacao']);
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
