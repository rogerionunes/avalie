<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Formularios;
use App\Models\FormulariosPerguntas;
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
        $formularios = Formularios::get();

        foreach ($formularios as $formulario) {

            $formularioList[] = [
                'codigo' => $formulario->id,
                'curso' => $formulario->curso->nm_curso,
                'nome' => $formulario->name,
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
        $cursos = DB::table('cursos')->get();

        return view('admin.formulario.add', [
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFormulario(Request $request)
    {

        $camposInvalidos = [];
        $campos = ['curso' => 'Curso', 'nome' => 'Nome', 'descricao' => 'Descrição Inicial', 'perguntas' => 'Pelo menos 1 pergunta deve ser criada'];

        foreach($campos as $name => $campo) {
            if (is_array($request->$name) && count($request->$name) == 0) {
                $camposInvalidos[] = 'Pelo menos 1 pergunta deve ser criada'; 
            } else if ($request->$name == '') {
                $camposInvalidos[] = 'O campo '.$campo.' é obrigatório.'; 
            }
        }

        if ($camposInvalidos) {
            return redirect()->back()->withInput($campos)->withErrors([$camposInvalidos]);
        }

        try {
            $formularios = Formularios::create(['name' => $request->nome, 'id_curso' => $request->curso, 'descricao' => $request->descricao]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro:'.$e->getMessage()]);
        }

        foreach ($request->perguntas as $pergunta) {
            $pergunta = explode('|', $pergunta);

            try {
                FormulariosPerguntas::create([
                    'id_formulario' => $formularios->id, 
                    'ordem' => $pergunta[0], 
                    'titulo' => $pergunta[3], 
                    'tipo' => $pergunta[1], 
                    'bloco' => $pergunta[2]
                    ]);
                return redirect()->route('admin.formulario.list');
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro:'.$e->getMessage()]);
            }

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
        $cursos = Cursos::get();
        $formulario = Formularios::find($id);
        $formulariosPerguntas = $formulario->formulariosPerguntas;
        $faaaa = FormulariosPerguntas::get();

        dd($faaaa);

        if ($formulariosPerguntas)

        return view('admin.formulario.edit', [
            'formulario' => $formulario,
            'formulariosPerguntas' => $formulariosPerguntas,
            'cursos' => $cursos
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

        $camposInvalidos = [];
        $campos = ['curso' => 'Curso', 'nome' => 'Nome', 'descricao' => 'Descrição Inicial', 'perguntas' => 'Pelo menos 1 pergunta deve ser criada'];

        foreach($campos as $name => $campo) {
            if (is_array($request->$name) && count($request->$name) == 0) {
                $camposInvalidos[] = 'Pelo menos 1 pergunta deve ser criada'; 
            } else if ($request->$name == '') {
                $camposInvalidos[] = 'O campo '.$campo.' é obrigatório.'; 
            }
        }

        if ($camposInvalidos) {
            return redirect()->back()->withInput($campos)->withErrors([$camposInvalidos]);
        }

        DB::beginTransaction();

        $formulario = Formularios::find($id);
        try {
            $formulario->name = $request->nome;
            $formulario->id_curso = $request->curso;
            $formulario->descricao = $request->descricao;
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['Erro ao salvar formularios: '.$e->getMessage()]);
        }

        $formPerguntas = [];

        if (!FormulariosPerguntas::get('id_formulario', $id)) {
            FormulariosPerguntas::where('id_formulario', $id)->delete();

            foreach ($request->perguntas as $pergunta) {

                $perguntaForm = explode('|', $pergunta);

                $formPerguntas = [
                    'id_formulario' => $formulario->id, 
                    'ordem' => $perguntaForm[0], 
                    'titulo' => $perguntaForm[3], 
                    'tipo' => $perguntaForm[1], 
                    'bloco' => $perguntaForm[2]
                ];

                try {
                    FormulariosPerguntas::create($formPerguntas);
                } catch (Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->withErrors(['Erro ao salvar formularios_perguntas:'.$e->getMessage()]);
                }

            }
        }

        DB::commit();

        return redirect()->route('admin.formulario.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $formPerguntas = FormulariosPerguntas::where('id_formulario', $id)->delete();
        $formulario = Formularios::where('id', $id)->delete();

        if ($formPerguntas && $formulario) {
            return redirect()->route('admin.formulario.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o formulario']);
    }
}
