<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CursoController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.curso.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {

        $cursoList = [];
        $cursos = DB::table('cursos')->get();

        foreach ($cursos as $curso) {

            $cursoList[] = [
                'codigo' => $curso->id,
                'nome' => $curso->nm_curso,
            ];
        }

        return view('admin.curso.list', [
            'cursoList' => $cursoList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.curso.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCurso(Request $request)
    {
        $campos = ['nome' => 'Nome'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }

        $curso = Cursos::create(['nm_curso' => $request->nome]);
        
        if ($curso) {
            return redirect()->route('admin.curso.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao cadastrar curso']);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = DB::table('cursos')->find($id);
        return view('admin.curso.edit', [
            'curso' => $curso
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCurso($id, Request $request)
    {
        
        $campos = ['nome' => 'Nome'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        $dados = ['nm_curso' => $request->nome];

        $curso = DB::table('cursos')
              ->where('id', $id)
              ->update($dados);

        if ($curso) {
            return redirect()->route('admin.curso.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o curso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $turmas = DB::table('turmas')->where('id_curso', $id)->first();

        if ($turmas) {
            return redirect()->back()->withInput()->withErrors(['O Curso está associado à uma turma.']);
        }
        $avaliacoes = DB::table('avaliacoes')->where('id_curso', $id)->first();

        if ($avaliacoes) {
            return redirect()->back()->withInput()->withErrors(['O Curso está associado à uma avaliação.']);
        }

        $curso = DB::table('cursos')->where('id', $id)->delete();

        if ($curso) {
            return redirect()->route('admin.curso.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o curso']);
    }
}
