<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
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
        
        $avaliacoes = $avaliacoes->orderBy('status', 'desc')->get();

        foreach ($avaliacoes as $avaliacao) {

            $avaliacaoList[] = [
                'codigo' => $avaliacao->id,
                'professor' => DB::table('users')->find($avaliacao->id_professor)->name,
                'curso' => DB::table('cursos')->find($avaliacao->id_curso)->nm_curso,
                'turma' => DB::table('turmas')->find($avaliacao->id_turma)->nm_turma,
                'disciplina' => DB::table('disciplinas')->find($avaliacao->id_disciplina)->nm_disciplina,
                'pin' => $avaliacao->pin,
                'data' => date('d/m/Y h:i:00', strtotime($avaliacao->created_at)),
                'status' => $avaliacao->status
            ];
        }
        
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
        
        $avaliacao = DB::table('avaliacoes')
        ->where(['id_professor' => Auth::user()->id, 
        'id_curso' => $request->curso,
        'id_turma' => $request->turma,
        'id_disciplina' => $request->disciplina,
        'status' => '1',
        'DAY(created_at)' => date('d'),
        'MONTH(created_at)' => date('m'),
        'YEAR(created_at)' => date('Y')])
        ->first();

        if ($avaliacao) {
            $dateCreated = explode(' ', $avaliacao->created_at);
            $dateCreated = $dateCreated[0];
            if ($dateCreated == date('Y-m-d')) {
                return json_encode(['status' => '0', 'erro' => 'Só é permitido criar uma avaliação por dia da mesma turma']);
            }
        }
        
        //insercao da avaliacao
        $avaliacaoAdd = Avaliacoes::create(
            ['id_professor' => Auth::user()->id, 
            'id_curso' => $request->curso,
            'id_turma' => $request->turma,
            'id_disciplina' => $request->disciplina,
            'pin' => $this->geraPin(),
            'dataValidade' => date('Y-m-d H:i:s', strtotime('now+1day'))]
        );
        
        if ($avaliacaoAdd) {
            return json_encode(['status' => '1']);
        }
        
        
        return json_encode(['status' => '0', 'erro' => 'Ocorreu algum erro ao cadastrar avaliacao']);
    }
    
    public function sessao(Request $request)
    {
        $pin = preg_replace('/[^A-Za-z0-9]/', "", $request->pin);

        $avaliacao = DB::table('avaliacoes')->where(['pin' => $pin])->first();

        if ($avaliacao) {

            if ($avaliacao->status == '0') {
                return redirect()->back()->withInput()->withErrors(['Sessão expirada.']);
            }

        
            $curso = DB::table('cursos')->find($avaliacao->id_curso);
            $turma = DB::table('turmas')->find($avaliacao->id_turma);
            $disciplina = DB::table('disciplinas')->find($avaliacao->id_disciplina);
            $professor = DB::table('users')->find($avaliacao->id_professor);

            return view('admin.avaliacao.sessao', [
                'disciplina' => $disciplina,
                'curso' => $curso,
                'turma' => $turma,
                'professor' => $professor
            ]);

        }

        return redirect()->back()->withInput()->withErrors(['PIN incorreto, digite novamente.']);
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
