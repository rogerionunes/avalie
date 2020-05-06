<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 
Route::get('/', 'LoginController@index');
Route::get('/admin', 'AdminController@index');

Auth::routes();

// admin/dashboard
Route::get('/admin', 'AuthController@dashboard')->name('admin.dashboard');

// login
Route::get('/admin/login', 'AuthController@login')->name('admin.login');
Route::post('/admin/login/autenticar', 'AuthController@autenticar')->name('admin.login.autenticar');
Route::get('/admin/login/logout', 'AuthController@logout')->name('admin.login.logout');

// create admin
Route::get('/admin/login/createUser', 'AuthController@createUser')->name('admin.login.createUser');

// user
Route::get('/admin/user/', 'UsersController@index')->name('admin.users');
Route::get('/admin/user/list', 'UsersController@list')->name('admin.users.list');
Route::get('/admin/user/add', 'UsersController@add')->name('admin.users.add');
Route::post('/admin/user/addUser', 'UsersController@addUser')->name('admin.users.addUser');
Route::get('/admin/user/edit/{id}', 'UsersController@edit')->name('admin.users.edit');
Route::post('/admin/user/editUser/{id}', 'UsersController@editUser')->name('admin.users.editUser');
Route::get('/admin/user/delete/{id}', 'UsersController@delete')->name('admin.users.delete');

// curso
Route::get('/admin/curso/', 'CursoController@index')->name('admin.curso');
Route::get('/admin/curso/list', 'CursoController@list')->name('admin.curso.list');
Route::get('/admin/curso/add', 'CursoController@add')->name('admin.curso.add');
Route::post('/admin/curso/addCurso', 'CursoController@addCurso')->name('admin.curso.addCurso');
Route::get('/admin/curso/edit/{id}', 'CursoController@edit')->name('admin.curso.edit');
Route::post('/admin/curso/editCurso/{id}', 'CursoController@editCurso')->name('admin.curso.editCurso');
Route::get('/admin/curso/delete/{id}', 'CursoController@delete')->name('admin.curso.delete');

// disciplina
Route::get('/admin/disciplina/', 'DisciplinaController@index')->name('admin.disciplina');
Route::get('/admin/disciplina/list', 'DisciplinaController@list')->name('admin.disciplina.list');
Route::get('/admin/disciplina/add', 'DisciplinaController@add')->name('admin.disciplina.add');
Route::post('/admin/disciplina/addDisciplina', 'DisciplinaController@addDisciplina')->name('admin.disciplina.addDisciplina');
Route::get('/admin/disciplina/edit/{id}', 'DisciplinaController@edit')->name('admin.disciplina.edit');
Route::post('/admin/disciplina/editDisciplina/{id}', 'DisciplinaController@editDisciplina')->name('admin.disciplina.editDisciplina');
Route::get('/admin/disciplina/delete/{id}', 'DisciplinaController@delete')->name('admin.disciplina.delete');

// turma
Route::get('/admin/turma/', 'TurmaController@index')->name('admin.turma');
Route::get('/admin/turma/list', 'TurmaController@list')->name('admin.turma.list');
Route::get('/admin/turma/add', 'TurmaController@add')->name('admin.turma.add');
Route::post('/admin/turma/addTurma', 'TurmaController@addTurma')->name('admin.turma.addTurma');
Route::get('/admin/turma/edit/{id}', 'TurmaController@edit')->name('admin.turma.edit');
Route::post('/admin/turma/editTurma/{id}', 'TurmaController@editTurma')->name('admin.turma.editTurma');
Route::get('/admin/turma/delete/{id}', 'TurmaController@delete')->name('admin.turma.delete');
