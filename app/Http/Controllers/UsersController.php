<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return redirect()->route('admin.users.list');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {

        $tipoUsuarioList = [
            'S' => 'Super Usuário',
            'P' => 'Professor',
            'C' => 'Coordenador',
        ];

        $usersList = [];
        $users = DB::table('users')->get();

        foreach ($users as &$user) {

            if ($user->tp_usuario == 'S') {
                continue;
            }

            $usersList[] = [
                'codigo' => $user->id,
                'usuario' => $user->name,
                'email' => $user->email,
                'tipoUsuario' => $tipoUsuarioList[$user->tp_usuario],
                'tipoUsuarioCode' => $user->tp_usuario,
                'idUser' => $user->id,
            ];
        }

        return view('admin.users.list', [
            'usersList' => $usersList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.users.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request)
    {
        $campos = ['nome' => 'Nome', 'email' => 'Email', 'senha' => 'Senha', 'tipoUsuario'=> 'Tipo de Usuário'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput($campos)->withErrors(['Email não válido']);
        }
        
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput($campos)->withErrors(['Email não válido']);
        }

        $userSameEmail = DB::table('users')->where('email', $request->email)->get();
        
        if ($userSameEmail) {
            return redirect()->back()->withInput($campos)->withErrors(['Email já está sendo utilizado']);
        }

        $user = Users::create(
            ['name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'tp_usuario' => $request->tipoUsuario]
        );
        
        if ($user) {
            return redirect()->route('admin.users.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao cadastrar usuario']);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->find($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id, Request $request)
    {
        
        $campos = ['nome' => 'Nome', 'email' => 'Email', 'tipoUsuario'=> 'Tipo de Usuário'];
        
        foreach($campos as $name => $campo) {
            if ($request->$name == ''){
                return redirect()->back()->withInput($campos)->withErrors(['O campo '.$campo.' é obrigatório.']);
            }
        }
        
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput($campos)->withErrors(['Email não válido']);
        }
        
        $dados = ['name' => $request->nome,
        'email' => $request->email,
        'tp_usuario' => $request->tipoUsuario];

        if ($request->senha) {
            $dados['password'] = Hash::make($request->senha);
        }

        $user = DB::table('users')
              ->where('id', $id)
              ->update($dados);

        if ($user) {
            return redirect()->route('admin.users.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao editar o usuário']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $disciplinas = DB::table('disciplinas')->where('id_professor', $id)->first();

        if ($disciplinas) {
            return redirect()->back()->withInput()->withErrors(['O usuário está associado à uma disciplina.']);
        }

        $avaliacoes = DB::table('avaliacoes')->where('id_professor', $id)->first();

        if ($avaliacoes) {
            return redirect()->back()->withInput()->withErrors(['O usuário está associado à uma avaliação.']);
        }

        $user = DB::table('users')->where('id', $id)->delete();

        if ($user) {
            return redirect()->route('admin.users.list');
        }
        
        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao deletar o usuário']);
    }
}
