<?php
/**
 * Created by PhpStorm.
 * Filename: edit.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 18/09/2024
 * Time: 9:23 a. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Proveedores|Actualizar Proveedor: {{$proveedor->nombre}}</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualice al Proveedor</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/proveedores',$proveedor->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empresa">Nombre Empresa</label><b style="color: red"> *</b>
                                    <input type="text" class="form-control" value="{{$proveedor->empresa}}" name="empresa" required>
                                    @error('empresa')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label><b style="color: red"> *</b>
                                    <input type="text" class="form-control" value="{{$proveedor->direccion}}" name="direccion" required>
                                    @error('direccion')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono Empresa</label><b style="color: red"> *</b>
                                    <input type="number" class="form-control" value="{{$proveedor->telefono}}" name="telefono" required>
                                    @error('telefono')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label><b style="color: red"> *</b>
                                    <input type="email" class="form-control" value="{{$proveedor->email}}" name="email" required>
                                    @error('email')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre Contacto</label><b style="color: red"> *</b>
                                    <input type="text" class="form-control" value="{{$proveedor->nombre}}" name="nombre" required>
                                    @error('nombre')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular</label><b style="color: red"> *</b>
                                    <input type="number" class="form-control" value="{{$proveedor->celular}}" name="celular" required>
                                    @error('celular')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/proveedores')}}" class="btn btn-secondary btn-sm">Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Actualizar Proveedor</button>
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
