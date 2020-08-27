<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormularioController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.formulario.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $formularioList = [];
        $formularios = DB::table('formularios')->get();

        foreach ($formularios as $formulario) {

            $turma = DB::table('turmas')->find($formulario->id_turma);
            $cursoTurma = DB::table('cursos')->find($turma->id_curso);

            $formularioList[] = [
                'codigo' => $formulario->id,
                'nome' => $formulario->name
            ];
        }

        return view('admin.formulario.list', [
            'formularioList' => $formularioList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $professores = DB::table('users')->where('tp_usuario','P')->get();
        $turmas = DB::table('turmas')->get();

        foreach ($turmas as &$turma) {
            $turma->curso = DB::table('cursos')->find($turma->id_curso)->nm_curso;
        }

        return view('admin.formulario.add', [
            'professores' => $professores,
            'turmas' => $turmas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFormulario(Request $request)
    {
        $campos = ['nome' => 'Nome', 'professor' => 'Professores', 'turma' => 'Turma'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }

        try {
            Formularios::create(['nm_formulario' => $request->nome, 'id_turma' => $request->turma, 'id_professor' => $request->professor]);
            return redirect()->route('admin.formulario.list');
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
        $professores = DB::table('users')->where('tp_usuario','P')->get();
        $turmas = DB::table('turmas')->get();

        foreach ($turmas as &$turma) {
            $turma->curso = DB::table('cursos')->find($turma->id_curso)->nm_curso;
        }

        $formulario = DB::table('formularios')->find($id);

        return view('admin.formulario.edit', [
            'formulario' => $formulario,
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
    public function editFormulario($id, Request $request)
    {
        
        $campos = ['nome' => 'Nome', 'professor' => 'Professores', 'turma' => 'Turma'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        $dados = ['nm_formulario' => $request->nome, 'id_professor' => $request->professor, 'id_turma' => $request->turma];
        
        try {
            DB::table('formularios')
            ->where('id', $id)
            ->update($dados);

            return redirect()->route('admin.formulario.list');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o formulario:'.$e->getMessage()]);
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
        $formulario = DB::table('formularios')->where('id', $id)->delete();

        if ($formulario) {
            return redirect()->route('admin.formulario.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o formulario']);
    }
}
