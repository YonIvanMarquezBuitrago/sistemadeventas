<?php
/**
 * Created by PhpStorm.
 * Filename: create.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 3/09/2024
 * Time: 6:36 p. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Productos|Registro de un Nuevo Producto</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registre los datos del Nuevo Producto</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/productos/create')}}" method="post" enctype="multipart/form-data"> {{--enctype ya que se va a enviar imagen--}}
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoría</label>
                                            <select name="categoria_id" id="categoria_id" class="form-control">
                                                @foreach($categorias as $categoria)
                                                    {{--Se definió en la funcion index de C:\wamp64\www\sistemadeventas\app\Http\Controllers\CategoriaController.php--}}
                                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Código</label><b style="color: red"> *</b>
                                            <input type="text" class="form-control" value="{{old('codigo')}}" name="codigo" required>
                                            @error('codigo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre Producto</label><b style="color: red"> *</b>
                                            <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre" required>
                                            @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" class="form-control" value="0" name="stock" required>
                                            @error('stock')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock Mínimo</label>
                                            <input type="number" class="form-control" value="0" name="stock_minimo" required>
                                            @error('stock_minimo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock Máximo</label>
                                            <input type="number" class="form-control" value="0" name="stock_maximo" required>
                                            @error('stock_maximo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="text" class="form-control" value="{{old('precio_compra')}}" name="precio_compra" required>
                                            @error('precio_compra')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta</label>
                                            <input type="text" class="form-control" value="{{old('precio_venta')}}" name="precio_venta" required>
                                            @error('precio_venta')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha Ingreso</label>
                                            <input type="date" class="form-control" value="{{old('fecha_ingreso')}}" name="fecha_ingreso" required>
                                            @error('fecha_ingreso')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png, .ico, .psd, .gif, .ia" class="form-control">
                                    <br>
                                    <center>
                                        <output id="list"></output>
                                    </center>
                                    {{--Script para visualizar la imagen cargada--}}
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; //file List objet
                                            //Obtenemos la imagen del campo "file"
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //solo admitimos imagenes
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e) {
                                                        //insertamos la imagen
                                                        document.getElementById("list").innerHTML
                                                            = ['<img class="thumb thumbail" src="',
                                                            e.target.result,
                                                            '" width="100%" title="',
                                                            escape(theFile.name),
                                                            '"/>'].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }

                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/productos')}}" class="btn btn-secondary btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Registrar Producto</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
    {{--el administrador de mensajes se copió en C:\wamp64\www\sistemadeventas\vendor\jeroennoten\laravel-adminlte\resources\views\page.blade.php--}}
@stop
