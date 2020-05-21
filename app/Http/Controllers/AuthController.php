<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {

            if (Auth::user()->tp_usuario == 'P') {
                return view('admin.dashboardProfessor');
            }

            return view('admin.dashboard');

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
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem']);
    }

    public function logout() 
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createUser()
    {
        $user = Users::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123321'),
            'tp_usuario' => 'S'
        ]);

        if ($user) {
            return redirect()->route('admin.login');
        }

        return redirect()->back()->withInput()->withErrors(['Ocorreu algum erro ao cadastrar usuario']);
    }
}
