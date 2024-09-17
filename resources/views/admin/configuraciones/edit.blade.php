<?php
/**
 * Created by PhpStorm.
 * Filename: edit.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 22/08/2024
 * Time: 4:53 p. m.
 */
?>
@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content_header')
    <h1>Configuraciones/Editar</h1>
@stop

@section('content')
    {{--Se copia el codigo de C:\wamp64\www\sistemadeventas\resources\views\admin\empresas\create.blade.php--}}
    <div class="row">
        <div class="col-md-12">
            {{-- Card Box --}}
            <div class="card-outline card-success" style="box-shadow: 5px 5px 5px 5px #cccccc">

                {{-- Card Header --}}
                {{--@hasSection('auth_header')--}}
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none">
                        {{--@yield('auth_header')--}}
                        <b>Datos Registrados</b>
                    </h3>
                </div>
                {{--@endif--}}

                {{-- Card Body --}}
                <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    {{--@yield('auth_body')--}}
                    {{--enctype="multipart/form-data" para que carque el archivo del logo--}}
                    <form action="{{url('/admin/configuracion',$empresa->id)}}" method="post" enctype="multipart/form-data">
                        {{--token de seguridad--}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png, .ico, .psd, .gif, .ia" class="form-control">
                                    {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                    @error('logo')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                    <br>
                                    <center>
                                        <output id="list">
                                            {{--Traer la imagen guardada--}}
                                            <img src="{{asset('storage/'.$empresa->logo)}}" width="80%" alt="logo">
                                        </output>
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
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <select name="pais" id="select_pais" class="form-control">
                                                @foreach($paises as $paise)
                                                    {{--Consulta: $empresa->pais == $paise->id ? 'selected':''--}}
                                                    <option value="{{$paise->id}}" {{$empresa->pais == $paise->id ? 'selected':''}}>{{$paise->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departamento">Estado/Dep/Prov/Región</label>
                                            <select name="departamento" id="select_departamento_2" class="form-control">
                                                @foreach($departamentos as $departamento)
                                                    {{--Pregunta: $empresa->departamento == $departamento->id ? 'selected':''--}}
                                                    <option value="{{$departamento->id}}" {{$empresa->departamento == $departamento->id ? 'selected':''}}>{{$departamento->name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="respuesta_pais">
                                                {{--La respuesta es la selección que está en C:\wamp64\www\sistemadeventas\resources\views\admin\empresas\cargar_estados.blade.php--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <select name="ciudad" id="select_ciudad_2" class="form-control">
                                                @foreach($ciudades as $ciudade)
                                                    {{--Pregunta: $empresa->departamento == $departamento->id ? 'selected':''--}}
                                                    <option value="{{$ciudade->id}}" {{$empresa->ciudad == $ciudade->id ? 'selected':''}}>{{$ciudade->name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="respuesta_estado">
                                                {{--La respuesta es la selección que está en C:\wamp64\www\sistemadeventas\resources\views\admin\empresas\cargar_estados.blade.php--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre de la Empresa</label><b style="color: red"> *</b>
                                            <input type="text" value="{{$empresa->nombre_empresa}}" name="nombre_empresa" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('nombre_empresa')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_empresa">Tipo de Empresa</label>
                                            <select name="tipo_empresa" id="" class="form-control">
                                                <option value="{{$empresa->tipo_empresa}}">{{$empresa->tipo_empresa}}</option>
                                                <option value="Empresa unipersonal">Empresa unipersonal</option>
                                                <option value="Sociedades por Acciones Simplificadas (S.A.S.)">Sociedades por Acciones Simplificadas (S.A.S.)</option>
                                                <option value="Sociedad Colectiva (S.C.)">Sociedad Colectiva (S.C.)</option>
                                                <option value="Sociedad Anónima (S.A.)">Sociedad Anónima (S.A.)</option>
                                                <option value="Sociedad de Responsabilidad Limitada (Ltda.)">Sociedad de Responsabilidad Limitada (Ltda.)</option>
                                                <option value="Sociedad en Comandita Simple (S. en C.)">Sociedad en Comandita Simple (S. en C.)</option>
                                                <option value="Sociedad Comandita por Acciones (S.C.A.)">Sociedad Comandita por Acciones (S.C.A.)</option>
                                                <option value="Empresa asociativa de trabajo.">Empresa asociativa de trabajo.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nit">NIT</label><b style="color: red"> *</b>
                                            <input type="text" value="{{$empresa->nit}}" name="nit" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('nit')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo de la Empresa</label><b style="color: red"> *</b>
                                            <input type="email" value="{{$empresa->correo}}" name="correo" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('correo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="moneda">Moneda</label>
                                            <select name="moneda" id="" class="form-control">
                                                @foreach($monedas as $moneda)
                                                    {{--Pregunta: $empresa->moneda == $moneda->id ? 'selected':''--}}
                                                    <option value="{{$moneda->id}}"  {{$empresa->moneda == $moneda->id ? 'selected':''}}>{{$moneda->name}} {{$moneda->symbol}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="codigo_postal">Cód Teléf</label>
                                            <select name="codigo_postal" id="" class="form-control">
                                                @foreach($paises as $paise)
                                                    <option value="{{$paise->phone_code}}" {{$empresa->codigo_postal == $paise->phone_code ? 'selected':''}}>{{$paise->phone_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label><b style="color: red"> *</b>
                                            <input type="text" value="{{$empresa->telefono}}" name="telefono" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('telefono')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_impuesto">Nombre Impuesto</label><b style="color: red"> *</b>
                                            <input type="text" value="{{$empresa->nombre_impuesto}}" name="nombre_impuesto" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('nombre_impuesto')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad_impuesto">% Impuesto</label><b style="color: red"> *</b>
                                            <input type="number" value="{{$empresa->cantidad_impuesto}}" name="cantidad_impuesto" class="form-control" required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('cantidad_impuesto')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Direccion de la Empresa</label><b style="color: red"> *</b>
                                            <input id="pac-input" value="{{$empresa->direccion}}" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                            {{--Muestra el error en el caso de que se vulnere la validación quitando el required del FrontEnd--}}
                                            @error('direccion')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                            {{--                                            <br>
                                                                                        <div id="map" style="width: 100%;height: 400px"></div>--}}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success btn-block">Actualizar Empresa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{--Script que responde con el id del pais elegido--}}
    <script>
        $('#select_pais').on('change', function () {
            var id_pais = $('#select_pais').val();
            //alert(pais);
            if (id_pais) {
                $.ajax({
                    url: "{{url('/admin/configuracion/pais/')}}"+'/'+id_pais,
                    type: "GET",
                    success: function (data) {
                        /*Borrar el campo repetido*/
                        $('#select_departamento_2').css('display','none');
                        $('#respuesta_pais').html(data);
                    }
                });
            } else {
                alert('Debes seleccionar un País');
            }
        });
    </script>

    {{--Script que responde con el id del estado elegido--}}
    <script>
        $(document).on('change','#select_estado',function (){
            var id_estado=$(this).val();
            //alert(id_estado);
            if (id_estado) {
                $.ajax({
                    url: "{{url('/admin/configuracion/estado/')}}"+'/'+id_estado,
                    type: "GET",
                    success: function (data) {
                        /*Borrar el campo repetido*/
                        $('#select_ciudad_2').css('display','none');
                        $('#respuesta_estado').html(data);
                    }
                });
            } else {
                alert('Debes seleccionar un Estado');
            }
        });
    </script>
@stop
