<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Disciplinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DisciplinaController extends Controller
{
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

            $disciplinaList[] = [
                'codigo' => $disciplina->id,
                'professor' => DB::table('users')->find($disciplina->id_professor)->name,
                'nome' => $disciplina->nm_disciplina,
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
        $professores = DB::table('users')->where('tp_usuario','P')->get();

        return view('admin.disciplina.add', [
            'professores' => $professores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisciplina(Request $request)
    {
        $campos = ['nome' => 'Nome', 'professor' => 'Professores'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }

        $disciplina = Disciplinas::create(['nm_disciplina' => $request->nome, 'id_professor' => $request->professor]);
        
        if ($disciplina) {
            return redirect()->route('admin.disciplina.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao cadastrar disciplina']);
        
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
        $disciplina = DB::table('disciplinas')->find($id);
        return view('admin.disciplina.edit', [
            'disciplina' => $disciplina,
            'professores' => $professores
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
        
        $campos = ['nome' => 'Nome', 'professor' => 'Professores'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        $dados = ['nm_disciplina' => $request->nome, 'id_professor' => $request->professor];

        $disciplina = DB::table('disciplinas')
              ->where('id', $id)
              ->update($dados);

        if ($disciplina) {
            return redirect()->route('admin.disciplina.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o disciplina']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $disciplina = DB::table('disciplinas')->where('id', $id)->delete();

        if ($disciplina) {
            return redirect()->route('admin.disciplina.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o disciplina']);
    }
}
