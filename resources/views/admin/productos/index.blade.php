<?php
/**
 * Created by PhpStorm.
 * Filename: index.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 3/09/2024
 * Time: 6:37 p. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Listado de Productos</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Productos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/productos/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo Productos</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead  class="thead-light">
                        <tr  style="text-align: center">
                            <th scope="col">#</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre Producto</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Precio Compra</th>
                            <th scope="col">Precio Venta</th>
                            <th scope="col">Imagen</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $contador_productos = 1; ?>
                        @foreach($productos as $producto){{--Se definió en la funcion index de C:\wamp64\www\sistemadeventas\app\Http\Controllers\ProductoController.php--}}
                            <tr>
                                <th scope="row" style="text-align: center; vertical-align: middle">{{$contador_productos++}}</th>
                                <td style="vertical-align: middle">{{$producto->categoria->nombre}}</td>
                                <td style="vertical-align: middle">{{$producto->codigo}}</td>
                                <td style="vertical-align: middle">{{$producto->nombre}}</td>
                                <td style="vertical-align: middle">{{$producto->descripcion}}</td>
                                <td style="text-align: center; background-color: lightyellow">{{$producto->stock}}</td>
                                <td style="vertical-align: middle">{{$producto->precio_compra}}</td>
                                <td style="vertical-align: middle">{{$producto->precio_venta}}</td>
                                <td style="text-align: center; vertical-align: middle">{{--Traer la imagen guardada--}}
                                    <img src="{{asset('storage/'.$producto->imagen)}}" width="80px" alt="imagen_producto">
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('/admin/productos',$producto->id)}}" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('/admin/productos/'.$producto->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form action="{{url('/admin/productos/'.$producto->id)}}" method="post"
                                              onclick="preguntar{{$producto->id}}(event)" id="miformulario{{$producto->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="border-radius: 0px 4px 4px 0px"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$producto->id}}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: "Desea Eliminar este Registro?",
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: "Eliminar",
                                                    confirmButtonColor: "#A5161D",
                                                    denyButtonColor: `#270A0A`,
                                                    denyButtonText: `Cancelar`,
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        //Swal.fire("Saved!", "", "success");
                                                        var form = $('#miformulario{{$producto->id}}');
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
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

    <script>
        $(function () {
            $("#example1").DataTable({
                "pageLength": 10,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                    "infoFiltered": "(Filtrado de MAX total Productos)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Productos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true, "lengthChange": true, "autoWidth": false,
                buttons: [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: '<button class="btn btn-primary btn-sm btn-block"><i class="bi bi-clipboard2-fill"></i> COPIAR</button>',
                        extend: 'copy',
                    }, {
                        /*text:'<i class="bi bi-file-earmark-pdf-fill"></i> PDF',*/
                        text: '<button class="btn btn-danger btn-sm btn-block"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</button>',
                        extend: 'pdf'
                    }, {
                        text: '<button class="btn btn-info btn-sm btn-block"><i class="bi bi-filetype-csv"></i> CSV</button>',
                        extend: 'csv'
                    }, {
                        text: '<button class="btn btn-success btn-sm btn-block"><i class="bi bi-file-earmark-excel-fill"></i> EXCEL</button>',
                        extend: 'excel'
                    }, {
                        text: '<button class="btn btn-warning btn-sm btn-block"><i class="bi bi-printer-fill"></i> IMPRIMIR</button>',
                        extend: 'print'
                    }
                    ]
                },
                    {
                        extend: 'colvis',
                        text: 'Visor de columnas',
                        collectionLayout: 'fixed three-column'
                    }
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

@stop
