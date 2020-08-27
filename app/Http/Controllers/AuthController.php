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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createAdmin()
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
