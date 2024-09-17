<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();//se crea la variable para poderla utilizar en el index de usuarios
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
              return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //echo "Función Store";
        //Prueba de Funcionalidad donde se carga una cadena JSON con los datos del formulario
        /* $datos=request()->all();
         return response()->json($datos);*/

        /*Validación Backend de Campos Requeridos en el formulario (no se ponen los Select)*/
        $request->validate([
            'nombre' => 'required|max:250|unique:categorias',//campo requerido máximo 250 caracteres
            'descripcion' => 'required|max:250',//campo requerido máximo 250 caracteres
        ]);
        //se envía creando un nuevo registro
        $categoria = new Categoria();
        //se pasan los parametros
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;//Empresa a la que pertenece esta categoría
        //guardamos
        $categoria->save();

        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Usuario registrado exitosamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        /*Se hace la respectiva consulta a la BD -  cambiamos find por findOr Fail para que envíe a la pagina 404 cuando el id no exista*/
        $categoria=Categoria::findOrFail($id);
        return view('admin.categorias.show',compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $categoria=Categoria::findOrFail($id);
        return view('admin.categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Prueba de Funcionalidad donde se carga una cadena JSON con los datos del formulario
        /* $datos=request()->all();
         return response()->json($datos);*/

        //La función update ejecuta las modificaciones que se hagan similar a create
        /*Se hace la consulta y se asigna a una variable*/
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $categoria=Categoria::findOrFail($id);
        //Validación backend: name de los input en el formulario
        $request->validate([
            'nombre' => 'required|max:250|unique:categorias,nombre,'.$id,//campo requerido máximo 250 caracteres
            'descripcion' => 'required|max:250',//campo requerido máximo 250 caracteres
        ]);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;//Empresa a la que pertenece este usuario
        //Guardamos los datos en la tabla de la BD
        $categoria->save();
        //Redireccionamos segun ruta definida en web.php
        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Categoría Actualizada exitosamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        Categoria::destroy($id);
        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Categoría Eliminada exitosamente!')
            ->with('icono', 'success');
    }
}
