<?php

use App\Http\Controllers\ListPokemonController;
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

Route::get('/', [ListPokemonController::class, 'index']);
Route::get('pokemon/detail/{id?}', [ListPokemonController::class, 'pokemonDetail']);
Route::post('save/pokemon', [ListPokemonController::class, 'savePokemon']);
Route::get('my-list-pokemon', [ListPokemonController::class, 'myListPokemon']);
Route::get('delete/pokemon/{id?}', [ListPokemonController::class, 'deleteMyListPokemon']);
