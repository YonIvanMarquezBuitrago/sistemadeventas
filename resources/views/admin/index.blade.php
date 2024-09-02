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
            <div class="info-box">
                <a href="{{url('/admin/roles')}}" class="info-box-icon bg-info">
                    <span><i class="fas fa-user-check"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Roles Registrados</span>
                    <span class="info-box-number">{{$total_roles}} Roles</span>
                </div>
            </div>
        </div>
        {{--Widget Usuarios--}}
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{url('/admin/roles')}}" class="info-box-icon bg-primary">
                    <span><i class="fas fa-users"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios Registrados</span>
                    <span class="info-box-number">{{$total_usuarios}} Usuarios</span>
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
