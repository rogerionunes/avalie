<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Turmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TurmaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.turma.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $turnoList = [
            'M' => 'Manhã',
            'T' => 'Tarde',
            'N' => 'Noite',
        ];
        $turmaList = [];
        $turmas = DB::table('turmas')->get();

        foreach ($turmas as $turma) {

            $turmaList[] = [
                'codigo' => $turma->id,
                'curso' => DB::table('cursos')->find($turma->id_curso)->nm_curso,
                'nome' => $turma->nm_turma,
                'ano' => $turma->ano,
                'status' => ($turma->status == '1')?'Andamento':'Concluído',
                'semestre' => ($turma->semestre == '1')?'1° Semestre':'2° Semestre',
                'turno' => $turnoList[$turma->turno],
            ];
        }

        return view('admin.turma.list', [
            'turmaList' => $turmaList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $cursos = DB::table('cursos')->get();

        return view('admin.turma.add', [
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTurma(Request $request)
    {
        $campos = ['nome' => 'Nome', 'curso' => 'Curso', 'ano' => 'Ano', 'semestre' => 'Semestre', 'turno' => 'Turno'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }

        $turma = Turma::create(
            ['nm_turma' => $request->nome, 
            'id_curso' => $request->curso,
            'ano' => $request->ano,
            'status' => '1',
            'semestre' => $request->semestre,
            'turno' => $request->turno,
            ]);
        
        if ($turma) {
            return redirect()->route('admin.turma.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao cadastrar turma']);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursos = DB::table('cursos')->get();
        $turma = DB::table('turmas')->find($id);
        return view('admin.turma.edit', [
            'turma' => $turma,
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editTurma($id, Request $request)
    {
        
        $campos = ['nome' => 'Nome', 'curso' => 'Curso', 'ano' => 'Ano', 'semestre' => 'Semestre', 'turno' => 'Turno'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        $dados = ['nm_turma' => $request->nome, 
        'id_curso' => $request->curso,
        'ano' => $request->ano,
        'status' => '1',
        'semestre' => $request->semestre,
        'turno' => $request->turno];

        $turma = DB::table('turmas')
              ->where('id', $id)
              ->update($dados);

        if ($turma) {
            return redirect()->route('admin.turma.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o turma']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $turma = DB::table('turmas')->where('id', $id)->delete();

        if ($turma) {
            return redirect()->route('admin.turma.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o turma']);
    }
}
