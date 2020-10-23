<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
use App\Models\Cursos;
use App\Models\Disciplinas;
use App\Models\Turmas;
use App\Models\Users;
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
                'professor' => Users::find($avaliacao->id_professor)->name,
                'curso' => Cursos::find($avaliacao->id_curso)->nm_curso,
                'turma' => Turmas::find($avaliacao->id_turma)->nm_turma,
                'disciplina' => Disciplinas::find($avaliacao->id_disciplina)->nm_disciplina,
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
    public function addSessao(Request $request)
    {
        dd($request);
    }
    
    public function sessao(Request $request)
    {
        Users::create([
            'name' => 'teste',
            'email' => 'teste@gmail.com',
            'password' => Hash::make('123456'),
            'tp_usuario' => 'C'
        ]);
        dd('foi');
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
            $listPerguntasN = [];

            foreach ($formulariosPerguntas as $pergunta) {
                switch ($pergunta->bloco) {
                    case 'DP':
                        $listPerguntasDP[] = $pergunta;
                        break;
                    case 'IA':
                        $listPerguntasIA[] = $pergunta;
                        break;
                    case 'N':
                        $listPerguntasN[] = $pergunta;
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
                'listPerguntasN' => $listPerguntasN,
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
