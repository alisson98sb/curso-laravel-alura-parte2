<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;


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


Route::get('/series'                                                ,   'SeriesController@index')->name('listar_series');
Route::get('/series/criar'                                          ,   'SeriesController@create')->name('form_criar_serie');
Route::get('/series/{serieId}/temporadas'                           ,   'TemporadasController@index');

Route::post('/series/criar'                                         ,   'SeriesController@store');
Route::post('/series/{id}/editaNome'                                ,   'SeriesController@editaNome');

Route::delete('/series/{id}'                                        ,   'SeriesController@destroy');
Route::delete('/series/{id}'                                        ,   'SeriesController@destroy');

Route::get('/temporadas/{temporada}/episodios'                      ,   'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir'            ,   'EpisodiosController@assistir');
