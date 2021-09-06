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

Route::get('/', function () {
    return view('livewire/empleados/index');
});

Auth::routes(["register" => false,
			"login"=> false	
			]);


//Route Hooks - Do not delete//
	Route::view('puestos', 'livewire.puestos.index')->middleware('auth');
	Route::view('empleados', 'livewire.empleados.index')->middleware('auth');