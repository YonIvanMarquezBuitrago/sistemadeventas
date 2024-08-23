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
{{--<h1>Bienvenido a la Vista Principal de Admin</h1>
<p>
    @if($message=Session::get('mensaje'))
        {{$message}}
    @endif
</p>--}}


@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido {{$empresa->nombre_empresa}}</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    /*Se pregunta si existen mensaje y un icono*/
    @if(($mensaje=Session::get('mensaje'))&&($icono=Session::get('icono')))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "{{$icono}}",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

@stop
