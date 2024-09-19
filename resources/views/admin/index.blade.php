<?php
/**
 * Created by PhpStorm.
 * Filename: index.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 21/08/2024
 * Time: 2:51 p. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1>Bienvenido {{$empresa->nombre_empresa}}</h1>
@stop

@section('content')
    <div class="row">
        {{--Widget Roles--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/roles')}}" class="info-box-icon bg-info">
                    <span><i class="fas fa-user-check"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Roles Registrados</span>
                    <span class="info-box-number">{{$total_roles}} Roles</span>{{--se define en C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php--}}
                </div>
            </div>
        </div>{{--/Widget Roles--}}
        {{--Widget Usuarios--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/roles')}}" class="info-box-icon bg-primary">
                    <span><i class="fas fa-users"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios Registrados</span>
                    <span class="info-box-number">{{$total_usuarios}} Usuarios</span>{{--se define en C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php--}}
                </div>
            </div>
        </div>{{--/Widget Usuarios --}}
        {{--Widget Categorías--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/categorías')}}" class="info-box-icon bg-success">
                    <span><i class="fas fa-tags"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Categorías Registradas</span>
                    <span class="info-box-number">{{$total_categorias}} Categorías</span>{{--se define en C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php--}}
                </div>
            </div>
        </div>{{--/Widget Categorías--}}
        {{--Widget Productos--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/productos')}}" class="info-box-icon bg-warning">
                    <span><i class="fas fa-list"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Productos Registrados</span>
                    <span class="info-box-number">{{$total_productos}} Productos</span>{{--se define en C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php--}}
                </div>
            </div>
        </div>{{--/Widget Productos--}}
        {{--Widget Proveedores--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/proveedores')}}" class="info-box-icon bg-dark">
                    <span><i class="fas fa-solid fa-truck"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Proveedores Registrados</span>
                    <span class="info-box-number">{{$total_proveedores}} Proveedores</span>{{--se define en C:\wamp64\www\sistemadeventas\app\Http\Controllers\AdminController.php--}}
                </div>
            </div>
        </div>{{--/Widget Productos--}}
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


@stop

@section('js')
    {{--el administrador de mensajes se copió en C:\wamp64\www\sistemadeventas\vendor\jeroennoten\laravel-adminlte\resources\views\page.blade.php--}}
@stop
