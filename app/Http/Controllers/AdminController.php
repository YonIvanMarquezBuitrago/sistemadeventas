<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //Se crea segun la ruta
    public function index()
    {
        $total_roles=Role::count();
        $total_usuarios=User::count();
        $total_categorias=Categoria::count();
        $total_productos=Producto::count();

        /*Preguntamos si está logueado o no*/
        /*$empresa_id=Auth::user()->empresa_id;*/
        $empresa_id=  Auth::check() ? Auth::user()->empresa_id : redirect()->route('login')->send();

        $empresa=Empresa::where('id',$empresa_id)->first();
        return view('admin.index',compact('empresa','total_roles','total_usuarios','total_categorias','total_productos'));
    }
}
