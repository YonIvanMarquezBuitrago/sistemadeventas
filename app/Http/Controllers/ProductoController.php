<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->get();//se crea la variable para poderla utilizar en el index de productos
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();//Se traen todas las categorias registradas
        return view('admin.productos.create', compact('categorias'));
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
            'codigo' => 'required|unique:productos,codigo',/*este campo es requerido y único en la tabla productos*/
            'nombre' => 'required|unique:productos,nombre',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ]);

        /*Envío de los datos registrados de el producto en el formulario a la tabla de la BD*/
        $producto = new Producto();
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id  = $request->categoria_id ;
        $producto->empresa_id  = Auth::user()->empresa_id ;
        $producto->save();
        /*Se define si el usuario desea o no cambiar la imagen del logo*/
        if ($request->hasFile('imagen')) {
            /*Elimina la imagen antigua*/
            /*Storage::delete('public/'.$producto->imagen);*/
            /*Definimos el guardado de la imagen a la carpeta logo de forma pública C:\wamp64\www\sistemadeventas\storage\app\public\logo*/
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Se registró el producto de manera Exitosa!!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        /*Se hace la respectiva consulta a la BD -  cambiamos find por findOr Fail para que envie a la pagina 404 cuando el id no exista*/
        $producto=Producto::findOrFail($id);
        return view('admin.productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        //En singular se hace la busqueda en el Modelo (consulta), con find($id) encuentra los id, pero si el id no existe arroja error, por ello se usa mejor findOrFail($id)
        $producto=Producto::findOrFail($id);
        $categorias = Categoria::all();//Se traen todas las categorias registrados
        return view('admin.productos.edit',compact('producto','categorias'));
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
        $producto=Producto::findOrFail($id);
        //Validación backend: name de los input en el formulario
        /*Validación Backend de Campos Requeridos en el formulario (no se ponen los Select)*/
        $request->validate([
            'codigo' => 'required|unique:productos,codigo,'.$id,/*este campo es requerido y único en la tabla productos*/
            'nombre' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ]);
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id  = $request->categoria_id ;
        $producto->empresa_id  = Auth::user()->empresa_id ;
        /*Se define si el usuario desea o no cambiar la imagen del logo*/
        if ($request->hasFile('imagen')) {
            /*Elimina la imagen antigua*/
            Storage::delete('public/'.$producto->imagen);
            /*Definimos el guardado de la imagen a la carpeta logo de forma pública C:\wamp64\www\sistemadeventas\storage\app\public\logo*/
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }
        $producto->save();
        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Se actualizó el producto de manera Exitosa!!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        $producto=Producto::findOrFail($id);
        Producto::destroy($id);
        /*Elimina la imagen */
        Storage::delete('public/'.$producto->imagen);
        //Ruta a donde debe ir despues de guardar, los mensajes estan configurados en C:\wamp64\www\sistemadeventas\resources\views\layouts\admin.blade.php
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto Eliminado exitosamente!')
            ->with('icono', 'success');
    }
}
