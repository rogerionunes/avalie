<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
use App\Models\Cursos;
use App\Models\Disciplinas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DisciplinaController extends Controller
{

    public function __construct()
    {
        $this->avaliacoes = new Avaliacoes();
        $this->disciplinas = new Disciplinas();
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.disciplina.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {

        $disciplinaList = [];
        $disciplinas = DB::table('disciplinas')->get();

        foreach ($disciplinas as $disciplina) {

            $turma = DB::table('turmas')->find($disciplina->id_turma);
            $cursoTurma = DB::table('cursos')->find($turma->id_curso);

            $disciplinaList[] = [
                'codigo' => $disciplina->id,
                'professor' => DB::table('users')->find($disciplina->id_professor)->name,
                'turma' => $cursoTurma->nm_curso.' - '.$turma->nm_turma,
                'nome' => $disciplina->nm_disciplina
            ];
        }

        return view('admin.disciplina.list', [
            'disciplinaList' => $disciplinaList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $professores = DB::table('users')->whereIn('tp_usuario', ['P','C'])->get();
        $turmas = DB::table('turmas')->get();

        foreach ($turmas as &$turma) {
            $turma->curso = DB::table('cursos')->find($turma->id_curso)->nm_curso;
        }

        return view('admin.disciplina.add', [
            'professores' => $professores,
            'turmas' => $turmas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisciplina(Request $request)
    {
        $campos = ['nome' => 'Nome', 'professor' => 'Professores', 'turma' => 'Turma'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }

        try {
            Disciplinas::create(['nm_disciplina' => $request->nome, 'id_turma' => $request->turma, 'id_professor' => $request->professor]);
            return redirect()->route('admin.disciplina.list');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro:'.$e->getMessage()]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professores = DB::table('users')->whereIn('tp_usuario',['P', 'C'])->get();
        $turmas = DB::table('turmas')->get();

        foreach ($turmas as &$turma) {
            $turma->curso = DB::table('cursos')->find($turma->id_curso)->nm_curso;
        }

        $disciplina = DB::table('disciplinas')->find($id);

        return view('admin.disciplina.edit', [
            'disciplina' => $disciplina,
            'professores' => $professores,
            'turmas' => $turmas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDisciplina($id, Request $request)
    {
        
        $campos = ['nome' => 'Nome', 'professor' => 'Professores', 'turma' => 'Turma'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        $dados = ['nm_disciplina' => $request->nome, 'id_professor' => $request->professor, 'id_turma' => $request->turma];
        
        try {
            DB::table('disciplinas')
            ->where('id', $id)
            ->update($dados);

            return redirect()->route('admin.disciplina.list');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o disciplina:'.$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $avaliacao = $this->avaliacoes->where('id_disciplina', $id)->first();

        if ($avaliacao) {
            return redirect()->back()->withInput()->withErrors(['A Disciplina esta associada à uma avaliação.']);
        }

        $disciplina = DB::table('disciplinas')->where('id', $id)->delete();

        if ($disciplina) {
            return redirect()->route('admin.disciplina.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o disciplina']);
    }
}
