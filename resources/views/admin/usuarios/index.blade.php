<?php
/**
 * Created by PhpStorm.
 * Filename: index.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 31/08/2024
 * Time: 2:06 p. m.
 */
?>

@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1><b>Listado de Usuarios</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo Usuario</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">#</th>
                            <th scope="col">Rol del Usuario</th>
                            <th scope="col">Nombre del Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $contador_usuarios = 1; ?>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <th scope="row" style="text-align: center">{{$contador_usuarios++}}</th>
                                <td>{{$usuario->roles->pluck('name')->implode(', ')}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('/admin/usuarios',$usuario->id)}}" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('/admin/usuarios/'.$usuario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form action="{{url('/admin/usuarios/'.$usuario->id)}}" method="post"
                                              onclick="preguntar{{$usuario->id}}(event)" id="miformulario{{$usuario->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="border-radius: 0px 4px 4px 0px"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$usuario->id}}(event) {
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
                                                        var form = $('#miformulario{{$usuario->id}}');
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de MAX total Usuarios)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Usuarios",
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
