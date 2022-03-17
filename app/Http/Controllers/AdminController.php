<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }
    
    public function dashboard()
    {
        if (Auth::check()) {
            
            if (Auth::user()->tp_usuario == 'P') {  
                
                // total avaliacoes
                $avaliacoes = DB::table('avaliacoes');
                
                if (!in_array(Auth::user()->tp_usuario, ['S', 'C'])) {
                    $avaliacoes->where('id_professor', Auth::user()->id);
                }
                
                $avaliacoes = $avaliacoes->count();
                
                //total disciplinas
                $disciplinas = DB::table('disciplinas')->where('id_professor', Auth::user()->id)->get();

                //total turmas
                $turmas = [];

                foreach ($disciplinas as $disciplina) {
                    $turmasDisciplinas = DB::table('turmas_disciplinas')->where(['disciplina_id' => $disciplina->id]);
                    $turma = DB::table('turmas')->find($turmasDisciplinas->id_turma);
                    $turmas[$turmasDisciplinas->id_turma] = $turma;
                }
                
                // total cursos
                $cursos = [];
                foreach ($turmas as $turma) {
                    $curso = DB::table('cursos')->find($turma->id_curso);
                    $cursos[$curso->id] = $curso;
                }
                
                
                return view('admin.dashboardProfessor', 
                ['totalAvaliacoes' => $avaliacoes,
                'totalDisciplinas' => count($disciplinas),
                'totalTurmas' => count($turmas),
                'totalCursos' => count($cursos),
                ]);
            }
            
            $usuarios = DB::table('users')->whereIn('tp_usuario', ['C', 'P'])->count();

            $professores = DB::table('users')->where('tp_usuario', 'P')->get();

            $avaliacoes = DB::table('avaliacoes')->where('status', '1')->count();
            
            $disciplinas = DB::table('disciplinas')->count();
            
            $turmas = DB::table('turmas')->count();
            
            $cursos = DB::table('cursos')->count();
            
            return view('admin.dashboardCoordenador', 
            ['totalAvaliacoes' => $avaliacoes,
            'totalDisciplinas' => $disciplinas,
            'totalTurmas' => $turmas,
            'totalCursos' => $cursos,
            'totalUsuarios' => $usuarios,
            'totalProfessores' => $professores->count(),
            ]);
        }   
        
        return redirect()->route('admin.login');
    }
    
    public function login()
    {
        return view('admin.login');
    }

    public function autenticar(Request $request) 
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->withErrors(['Email não válido']);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin');
        }
        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem']);
    }

    public function logout() 
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
