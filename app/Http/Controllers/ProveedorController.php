<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();//se crea la variable para poderla utilizar en el index de proveedors
        $empresa=Empresa::where('id',Auth::user()->empresa_id)->first();
        return view('admin.proveedores.index', compact('proveedores','empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
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
            'empresa' => 'required',/*este campo es requerido en la tabla proveedors*/
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required',
            'celular' => 'required',
        ]);

        /*Envío de los datos registrados de el proveedor en el formulario a la tabla de la BD*/
        $proveedor = new Proveedor();
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;

        $proveedor->save();

        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se registró el proveedor de manera Exitosa!!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        /*Se hace la respectiva consulta a la BD -  cambiamos find por findOrFail para que envie a la pagina 404 cuando el id no exista*/
        $proveedor=Proveedor::findOrFail($id);

        return view('admin.proveedores.show',compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $proveedor=Proveedor::findOrFail($id);
        return view('admin.proveedores.edit',compact('proveedor'));
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
        $proveedor=Proveedor::findOrFail($id);
        //Validación backend: name de los input en el formulario
        /*Validación Backend de Campos Requeridos en el formulario (no se ponen los Select)*/
        $request->validate([
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required',
            'celular' => 'required',
        ]);
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id  = Auth::user()->empresa_id ;

        $proveedor->save();
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se actualizó el proveedor de manera Exitosa!!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        Proveedor::destroy($id);
        //Ruta a donde debe ir despues de guardar, los mensajes estan configurados en C:\wamp64\www\sistemadeventas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Proveedor Eliminado exitosamente!')
            ->with('icono', 'success');
    }
}
