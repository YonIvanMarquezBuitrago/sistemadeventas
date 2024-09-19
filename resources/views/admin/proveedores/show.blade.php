<?php
/**
 * Created by PhpStorm.
 * Filename: show.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 18/09/2024
 * Time: 9:24 a. m.
 */

?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Proveedores|Proveedor:{{$proveedor->nombre}}</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados del Proveedor</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empresa">Nombre Empresa</label>
                                    <p>{{$proveedor->empresa}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <p>{{$proveedor->direccion}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono Empresa</label>
                                    <p>{{$proveedor->telefono}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <p>{{$proveedor->email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre Contacto</label>
                                    <p>{{$proveedor->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <p>{{$proveedor->celular}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/proveedores')}}" class="btn btn-secondary btn-sm">Volver</a>
                                </div>
                            </div>
                        </div>
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
