<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'LoginController@index')->name('/');
Route::get('/sucesso', 'LoginController@success')->name('login.success');

// admin/dashboard
Route::get('/admin', 'AdminController@dashboard')->name('admin');
Route::get('/admin/login', 'AdminController@login')->name('admin.login');

// login admin
Route::post('/admin/login/autenticar', 'AdminController@autenticar')->name('admin.login.autenticar');
Route::get('/admin/login/logout', ['middleware' => 'auth', 'uses' => 'AdminController@logout'])->name('admin.login.logout');

// create admin
Route::get('/create/admin/new', 'AuthController@createAdmin');

// user
Route::get('/admin/user/', ['middleware' => 'auth', 'uses' => 'UsersController@index'])->name('admin.users');
Route::get('/admin/user/list', ['middleware' => 'auth', 'uses' => 'UsersController@list'])->name('admin.users.list');
Route::get('/admin/user/add', ['middleware' => 'auth', 'uses' => 'UsersController@add'])->name('admin.users.add');
Route::post('/admin/user/addUser', ['middleware' => 'auth', 'uses' => 'UsersController@addUser'])->name('admin.users.addUser');
Route::get('/admin/user/edit/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@edit'])->name('admin.users.edit');
Route::post('/admin/user/editUser/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@editUser'])->name('admin.users.editUser');
Route::get('/admin/user/delete/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@delete'])->name('admin.users.delete');

// curso
Route::get('/admin/curso/', ['middleware' => 'auth', 'uses' => 'CursoController@index'])->name('admin.curso');
Route::get('/admin/curso/list', ['middleware' => 'auth', 'uses' => 'CursoController@list'])->name('admin.curso.list');
Route::get('/admin/curso/add', ['middleware' => 'auth', 'uses' => 'CursoController@add'])->name('admin.curso.add');
Route::post('/admin/curso/addCurso', ['middleware' => 'auth', 'uses' => 'CursoController@addCurso'])->name('admin.curso.addCurso');
Route::get('/admin/curso/edit/{id}', ['middleware' => 'auth', 'uses' => 'CursoController@edit'])->name('admin.curso.edit');
Route::post('/admin/curso/editCurso/{id}', ['middleware' => 'auth', 'uses' => 'CursoController@editCurso'])->name('admin.curso.editCurso');
Route::get('/admin/curso/delete/{id}', ['middleware' => 'auth', 'uses' => 'CursoController@delete'])->name('admin.curso.delete');

// disciplina
Route::get('/admin/disciplina/', ['middleware' => 'auth', 'uses' => 'DisciplinaController@index'])->name('admin.disciplina');
Route::get('/admin/disciplina/list', ['middleware' => 'auth', 'uses' => 'DisciplinaController@list'])->name('admin.disciplina.list');
Route::get('/admin/disciplina/add', ['middleware' => 'auth', 'uses' => 'DisciplinaController@add'])->name('admin.disciplina.add');
Route::post('/admin/disciplina/addDisciplina', ['middleware' => 'auth', 'uses' => 'DisciplinaController@addDisciplina'])->name('admin.disciplina.addDisciplina');
Route::get('/admin/disciplina/edit/{id}', ['middleware' => 'auth', 'uses' => 'DisciplinaController@edit'])->name('admin.disciplina.edit');
Route::post('/admin/disciplina/editDisciplina/{id}', ['middleware' => 'auth', 'uses' => 'DisciplinaController@editDisciplina'])->name('admin.disciplina.editDisciplina');
Route::get('/admin/disciplina/delete/{id}', ['middleware' => 'auth', 'uses' => 'DisciplinaController@delete'])->name('admin.disciplina.delete');

// formulario
Route::get('/admin/formulario/', ['middleware' => 'auth', 'uses' => 'FormularioController@index'])->name('admin.formulario');
Route::get('/admin/formulario/list', ['middleware' => 'auth', 'uses' => 'FormularioController@list'])->name('admin.formulario.list');
Route::get('/admin/formulario/add', ['middleware' => 'auth', 'uses' => 'FormularioController@add'])->name('admin.formulario.add');
Route::post('/admin/formulario/addFormulario', ['middleware' => 'auth', 'uses' => 'FormularioController@addFormulario'])->name('admin.formulario.addFormulario');
Route::get('/admin/formulario/edit/{id}', ['middleware' => 'auth', 'uses' => 'FormularioController@edit'])->name('admin.formulario.edit');
Route::post('/admin/formulario/editFormulario/{id}', ['middleware' => 'auth', 'uses' => 'FormularioController@editFormulario'])->name('admin.formulario.editFormulario');
Route::get('/admin/formulario/delete/{id}', ['middleware' => 'auth', 'uses' => 'FormularioController@delete'])->name('admin.formulario.delete');

// turma
Route::get('/admin/turma/', ['middleware' => 'auth', 'uses' => 'TurmaController@index'])->name('admin.turma');
Route::get('/admin/turma/list', ['middleware' => 'auth', 'uses' => 'TurmaController@list'])->name('admin.turma.list');
Route::get('/admin/turma/add', ['middleware' => 'auth', 'uses' => 'TurmaController@add'])->name('admin.turma.add');
Route::post('/admin/turma/addTurma', ['middleware' => 'auth', 'uses' => 'TurmaController@addTurma'])->name('admin.turma.addTurma');
Route::get('/admin/turma/edit/{id}', ['middleware' => 'auth', 'uses' => 'TurmaController@edit'])->name('admin.turma.edit');
Route::post('/admin/turma/editTurma/{id}', ['middleware' => 'auth', 'uses' => 'TurmaController@editTurma'])->name('admin.turma.editTurma');
Route::get('/admin/turma/delete/{id}', ['middleware' => 'auth', 'uses' => 'TurmaController@delete'])->name('admin.turma.delete');

// Avaliacao
Route::get('/admin/avaliacao/', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@index'])->name('admin.avaliacao');
Route::get('/admin/avaliacao/list', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@list'])->name('admin.avaliacao.list');
Route::get('/admin/avaliacao/add', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@add'])->name('admin.avaliacao.add');
Route::get('/admin/avaliacao/finalizar/{id}', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@finalizar'])->name('admin.avaliacao.finalizar');
Route::get('/admin/avaliacao/listTurma', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@listTurma'])->name('admin.avaliacao.listTurma');
Route::get('/admin/avaliacao/listDisciplina', ['middleware' => 'auth', 'uses' => 'AvaliacaoController@listDisciplina'])->name('admin.avaliacao.listDisciplina');
Route::get('/admin/avaliacao/sessao', 'AvaliacaoController@sessao')->name('admin.avaliacao.sessao');
Route::post('/admin/avaliacao/addSessao', 'AvaliacaoController@addSessao')->name('admin.avaliacao.addSessao');
Route::get('/admin/avaliacao/results', 'AvaliacaoController@results')->name('admin.avaliacao.results');
Route::get('/admin/avaliacao/sendEmail', 'AvaliacaoController@sendEmail')->name('admin.avaliacao.sendEmail');

// Relatorios

//Comparar Avaliações
Route::get('/admin/comparar/', ['middleware' => 'auth', 'uses' => 'CompararController@index'])->name('admin.comparar');
Route::get('/admin/comparar/filter', ['middleware' => 'auth', 'uses' => 'CompararController@filter'])->name('admin.comparar.filter');
Route::get('/admin/comparar/relatorio/{curso}/{turma}/{disciplinas}', ['middleware' => 'auth', 'uses' => 'CompararController@relatorio'])->name('admin.comparar.relatorio');
Route::get('/admin/comparar/listDisciplina', ['middleware' => 'auth', 'uses' => 'CompararController@listDisciplina'])->name('admin.comparar.listDisciplina');
Route::get('/admin/comparar/listTurma', ['middleware' => 'auth', 'uses' => 'CompararController@listTurma'])->name('admin.comparar.listTurma');

Route::get('/admin/results/', 'ResultsController@index')->name('admin.results');
Route::get('/admin/results/filter/{id}/{download?}', 'ResultsController@filter')->name('admin.results.filter');
Route::get('/admin/results/ajaxFilter', 'ResultsController@ajaxFilter')->name('admin.results.ajaxFilter');
