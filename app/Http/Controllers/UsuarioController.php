<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Solo traemos los usuarios que pertenecen a la empresa logueada
        $empresa_id = Auth::user()->empresa_id;
        $usuarios = User::where('empresa_id', $empresa_id)->get();//se crea la variable para poderla utilizar en el index de usuarios
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();//Se traen todos los roles registrados
        return view('admin.usuarios.create', compact('roles'));
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
            'name' => 'required|max:250',//campo requerido máximo 250 caracteres
            'email' => 'required|max:250|unique:users',//campo requerido máximo 250 caracteres, único en la tabla users
            'password' => 'required|max:250|confirmed',//campo requerido máximo 250 caracteres y debe ser confirmado
        ]);
        //se envía creando un nuevo registro
        $usuario = new User();
        //se pasan los parametros
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);//la contraseña debe ser enviada encriptada con el método Hash
        $usuario->empresa_id = Auth::user()->empresa_id;//Empresa a la que pertenece este usuario
        //guardamos
        $usuario->save();
        /*Asignación del Rol*/
        $usuario->assignRole($request->role);
        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado exitosamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        /*Se hace la respectiva consulta a la BD -  cambiamos find por findOr Fail para que envie a la pagina 404 cuando el id no exista*/
        $usuario=User::findOrFail($id);
        return view('admin.usuarios.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $usuario=User::findOrFail($id);
        $roles = Role::all();//Se traen todos los roles registrados
        return view('admin.usuarios.edit',compact('usuario','roles'));
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
        $usuario = User::findOrFail($id);
        //Validación backend: name de los input en el formulario
        $request->validate([
            'name' => 'required|max:250',//campo requerido máximo 250 caracteres
            'email' => 'required|max:250|unique:users,email,'.$usuario->id,//campo requerido máximo 250 caracteres, único en la tabla users
            'password' => 'nullable|max:250|confirmed',//campo máximo 250 caracteres y debe ser confirmado
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        //Definimos el tipo de encriptado para el password y solo si se escribe algo en el campo se confirm y guarda la nueva contraseña
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->empresa_id = Auth::user()->empresa_id;//Empresa a la que pertenece este usuario
        //Guardamos los datos en la tabla de la BD
        $usuario->save();
        /*Sincronizar el Rol*/
        $usuario->syncRoles($request->role);
        //Redireccionamos segun ruta definida en web.php
        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario Actualizado exitosamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        User::destroy($id);
        //Ruta a donde debe ir despues de guardar, los mensajes estan configuradoes en C:\wamp64\www\sisreservacitas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario Eliminado exitosamente!')
            ->with('icono', 'success');
    }
}
