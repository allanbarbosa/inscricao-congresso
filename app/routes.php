<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{
	return View::make('home');
});

/*//Route::get('/inscricao', function(){
//	return View::make('Inscricao.form');
//});
Route::get('/agradeco', function(){
	return View::make('hello');
});*/

Route::get('/municipios', '\Congresso\ModuloAdministrativo\Municipios\Controllers\MunicipiosController@getMunicipios');
Route::get('/instituicoes', '\Congresso\ModuloAdministrativo\Instituicao\Controllers\InstituicaoController@getInstituicoes');

Route::controller('/inscricao', '\Congresso\ModuloInscricao\Participante\Controllers\ParticipanteController');
Route::controller('/caravana','\Congresso\ModuloInscricao\Caravana\Controllers\CaravanaController');

Route::get('login', array('before' => array('guest'), 'uses' => 'Congresso\ModuloAdministrativo\Usuario\Controllers\LoginController@getIndex'));
Route::post('login', array('before' => array('guest', 'csrf'), 'uses' => 'Congresso\ModuloAdministrativo\Usuario\Controllers\LoginController@postIndex'));
Route::get('logout', array('before' => 'auth', 'uses' =>'Congresso\ModuloAdministrativo\Usuario\Controllers\LoginController@getLogout'));

Route::group(array('before' => array('auth')), function(){

	Route::get('/admin', function(){
		return View::make('admin.home');
	});

	Route::controller('/admin/participantes', 'Congresso\ModuloInscricao\Participante\Controllers\ParticipanteController');
});