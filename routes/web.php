<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Ruta sin Autenticación*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

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

/*Rutas para Roles*/
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store.')->middleware('auth');
Route::get('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

/*Rutas para Usuarios*/
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store.')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

/*Rutas para Categorías*/
Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth');
Route::get('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth');
Route::post('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'store'])->name('admin.categorias.store.')->middleware('auth');
Route::get('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth');
Route::get('/admin/categorias/{id}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth');
Route::put('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth');

/*Rutas para Productos*/
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth');
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store.')->middleware('auth');
Route::get('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth');
Route::get('/admin/productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth');
Route::put('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth');

/*Rutas para Proveedores*/
Route::get('/admin/proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('admin.proveedores.index')->middleware('auth');
Route::get('/admin/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedores.create')->middleware('auth');
Route::post('/admin/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedores.store.')->middleware('auth');
Route::get('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'show'])->name('admin.proveedores.show')->middleware('auth');
Route::get('/admin/proveedores/{id}/edit', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedores.edit')->middleware('auth');
Route::put('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth');
