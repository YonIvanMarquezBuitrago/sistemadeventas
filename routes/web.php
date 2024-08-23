<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Ruta sin Autenticación*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Ruta create empresas retornando una vista*/
/*Route::get('/create_empresa', function () {
    return view('admin.empresas.create');
});*/

/*->middleware('auth') obliga a que se autentique el usuario*/

/*Ruta admin retornando un controlador*/
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
/*Ruta create empresas retornando un controlador (crear-empresa)*/
Route::get('/create_empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.empresas.create');
/*Ruta para elegir estados según el país*/
Route::get('/create_empresa/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.create.buscar.estado');
/*Ruta para elegir ciudades según el estado*/
Route::get('/create_empresa/estado/{id_estado}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.create.buscar.ciudad');
/*Ruta para crear la empresa*/
Route::post('/create_empresa/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.store.');

/*Ruta admin/configuracion retornando un controlador*/
Route::get('/admin/configuracion', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
/*Ruta para elegir estados según el país en editar empresa*/
Route::get('/admin/configuracion/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.configuracion.buscar.estado');
/*Ruta para elegir ciudades según el estado en editar empresa*/
Route::get('/admin/configuracion/estado/{id_estado}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.configuracion.buscar.ciudad');
/*Ruta para actualizar empresa*/
Route::put('/admin/configuracion/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.empresas.configuracion.update');
