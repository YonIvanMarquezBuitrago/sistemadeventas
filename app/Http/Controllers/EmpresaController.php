<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*Consulta a la BD para traer los paises*/
        $paises = DB::table('countries')->get();
        /*Consulta a la BD para traer los estados*/
        $estados = DB::table('states')->get();
        /*Consulta a la BD para traer las ciudades*/
        $ciudades = DB::table('cities')->get();
        /*Consulta a la BD para traer la moneda*/
        $monedas = DB::table('currencies')->get();
        //echo "Hola desde el controlador de Empresa";
        /*Enrutar la vista*/
        return view('admin.empresas.create', compact('paises', 'estados', 'ciudades', 'monedas'));

    }

    public function buscar_estado($id_pais)
    {
        //echo $id_pais;
        try {
            /*Consulta directa a la BD para mostrar solo los estados del país seleccionado*/
            $estados = DB::table('states')->where('country_id', $id_pais)->get();
            return view('admin.empresas.cargar_estados', compact('estados'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error']);
        }
    }

    public function buscar_ciudad($id_estado)
    {
        //echo $id_estado;
        try {
            /*Consulta directa a la BD para mostrar solo los estados del país seleccionado*/
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error']);
        }
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
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas',/*este campo es requerido y único en la tabla empresas*/
            'telefono' => 'required',
            'correo' => 'required|unique:empresas',/*este campo es requerido y único en la tabla empresas*/
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpg, jpeg, png, ico, psd, gif, ia',/*este campo es requerido, solo recibe imágenes con estas extensiones */
        ]);

        /*Envío de los datos registrados de la Empresa en el formulario a la tabla de la BD*/
        $empresa = new Empresa();
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        /*Definimos el guardado de la imagen a la carpeta logo de forma pública C:\wamp64\www\sistemadeventas\storage\app\public\logo*/
        $empresa->logo = $request->file('logo')->store('logo', 'public');
        /*Se guardan los datos recopilados*/
        $empresa->save();

        /*Registro de un usuario administrador que se registra en la tabla User de la BD*/
        $usuario = new User();
        /*Asignación de datos*/
        $usuario->name = "Admin";//Dato genérico
        $usuario->email = $request->correo;//El mismo correo escrito en el formulario Empresa
        $usuario->password = Hash::make($request['nit']);//La contraseña va a ser el nit (encriptado) escrito en el formulario Empresa
        $usuario->empresa_id = $empresa->id;//Se pasa el id que se genera cuando se crea una nueva empresa
        /*Se guardan los datos recopilados*/
        $usuario->save();

        /*Hacer que el nuevo usuario entre al sistema autenticado apenas cree la nueva empresa*/
        Auth::login($usuario);

        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.index')->with('mensaje', 'Se registró la Empresa de manera Exitosa!!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        /*Consulta a la BD para traer los paises*/
        $paises = DB::table('countries')->get();
        /*Consulta a la BD para traer los estados*/
        $estados = DB::table('states')->get();
        /*Consulta a la BD para traer las ciudades*/
        // $ciudades = DB::table('cities')->get();
        /*Consulta a la BD para traer la moneda*/
        $monedas = DB::table('currencies')->get();

        /*Esta consulta es la misma de C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php*/
        $empresa_id = Auth::user()->empresa_id;
        /*->first() para que encuentre el primer resultado*/
        $empresa = Empresa::where('id', $empresa_id)->first();
        /*Consulta para traer datos registrados al formulario editar empresa*/
        $departamentos = DB::table('states')->where('country_id', $empresa->pais)->get();
        /*Consulta para traer el departamento al formulario editar empresa*/
        $ciudades = DB::table('cities')->where('state_id', $empresa->departamento)->get();
        return view('admin.configuraciones.edit', compact('paises', 'estados', 'monedas', 'empresa', 'departamentos', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Prueba de Funcionalidad donde se carga una cadena JSON con los datos del formulario
        /*$datos=request()->all();
        return response()->json($datos);*/

        /*Validación Backend de Campos Requeridos en el formulario (no se ponen los Select ni el logo)*/
        $request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas,nit,'.$id,/*este campo es requerido y único en la tabla empresas*/
            'telefono' => 'required',
            'correo' => 'required|unique:empresas,correo,'.$id,/*este campo es requerido y único en la tabla empresas*/
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
        ]);
        /*Envío de los datos actualizados de la Empresa en el formulario a la tabla de la BD*/
        $empresa = Empresa::find($id);
        /*En este nuevo registro que se asigne en este campo el dato que viene del formulario*/
        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;

        /*Se define si el usuario desea o no cambiar la imagen del logo*/
        if ($request->hasFile('logo')) {
            /*Elimina l aimagen antigua*/
            Storage::delete('public/'.$empresa->logo);
            /*Definimos el guardado de la imagen a la carpeta logo de forma pública C:\wamp64\www\sistemadeventas\storage\app\public\logo*/
            $empresa->logo = $request->file('logo')->store('logo', 'public');
        }

        /*Se guardan los datos recopilados*/
        $empresa->save();

        /*Búsqueda de un usuario administrador que se actualiza en la tabla User de la BD*/
        $usuario_id=Auth::user()->id;

        $usuario = User::find($usuario_id);
        /*Asignación de datos*/
        $usuario->name = "Admin";//Dato genérico
        $usuario->email = $request->correo;//El mismo correo escrito en el formulario Empresa
        $usuario->password = Hash::make($request['nit']);//La contraseña va a ser el nit (encriptado) escrito en el formulario Empresa
        $usuario->empresa_id = $empresa->id;//Se pasa el id que se genera cuando se crea una nueva empresa
        /*Se guardan los datos recopilados*/
        $usuario->save();

        /*Ruta a donde debe retornar en cuanto guarde*/
        return redirect()->route('admin.index')
            ->with('mensaje', 'Se actualizó la Empresa de manera Exitosa!!')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
