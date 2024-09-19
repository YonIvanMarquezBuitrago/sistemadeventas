<?php
/**
 * Created by PhpStorm.
 * Filename: index.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Proveedor PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 18/09/2024
 * Time: 9:23 a. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Listado de Proveedores</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Proveedores Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/proveedores/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo Proveedor</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead class="thead-light">
                        <tr style="text-align: center">
                            <th scope="col">#</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nombre Proveedor</th>
                            <th scope="col">Celular</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $contador_proveedores = 1; ?>
                        @foreach($proveedores as $proveedor)
                            {{--Se definió en la funcion index de C:\wamp64\www\sistemadeventas\app\Http\Controllers\ProveedorController.php--}}
                            <tr>
                                <th scope="row" style="text-align: center; vertical-align: middle">{{$contador_proveedores++}}</th>
                                <td style="vertical-align: middle">{{$proveedor->empresa}}</td>
                                <td style="vertical-align: middle">{{$proveedor->direccion}}</td>
                                <td style="vertical-align: middle">{{$proveedor->telefono}}</td>
                                <td style="vertical-align: middle">{{$proveedor->email}}</td>
                                <td style="vertical-align: middle">{{$proveedor->nombre}}</td>
                                <td style="vertical-align: middle">
                                    <a href="https://wa.me/{{$empresa->codigo_postal."".$proveedor->celular}}" class="btn btn-success btn-sm" target="_blank"> <i class="fab fa-whatsapp"></i>
                                    {{$empresa->codigo_postal." ".$proveedor->celular}}</a>
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('/admin/proveedores',$proveedor->id)}}" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('/admin/proveedores/'.$proveedor->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form action="{{url('/admin/proveedores/'.$proveedor->id)}}" method="post"
                                              onclick="preguntar{{$proveedor->id}}(event)" id="miformulario{{$proveedor->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="border-radius: 0px 4px 4px 0px"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$proveedor->id}}(event) {
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
                                                        var form = $('#miformulario{{$proveedor->id}}');
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                    "infoFiltered": "(Filtrado de MAX total Proveedores)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Proveedores",
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
