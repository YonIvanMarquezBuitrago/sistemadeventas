<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();//se crea la variable para poderla utilizar en el index de roles
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|unique:roles',/*este campo es requerido y único en la tabla roles*/
        ]);
        /*Envío de los datos registrados de la Empresa en el formulario a la tabla de la BD*/
        $rol = new Role();
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $rol->name = $request->name;
        $rol->guard_name = "web";
        /*Guardar en la tabla de la BD*/
        $rol->save();
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se registró El Rol de manera Exitosa!!')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        /*Se hace la respectiva consulta a la BD -  cambiamos find por findOr Fail para que envie a la pagina 404 cuando el id no exista*/
        $role=Role::findOrFail($id);
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $role=Role::findOrFail($id);
        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //echo "Función Store";
        //Prueba de Funcionalidad donde se carga una cadena JSON con los datos del formulario
        /* $datos=request()->all();
         return response()->json($datos);*/
        /*Validación Backend de Campos Requeridos en el formulario (no se ponen los Select)*/
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,/*este campo es requerido y único en la tabla roles*/
        ]);
        /*Envío de los datos registrados de la Empresa en el formulario a la tabla de la BD*/
        $rol = Role::findOrFail($id);
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $rol->name = $request->name;
        $rol->guard_name = "web";
        /*Guardar en la tabla de la BD*/
        $rol->save();
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se actualizó el Rol de manera Exitosa!!')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::destroy($id);
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se eliminó el Rol de manera Exitosa!!')
            ->with('icono','success');
    }
}
