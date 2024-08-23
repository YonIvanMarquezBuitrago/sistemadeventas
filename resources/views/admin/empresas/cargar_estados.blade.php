<?php
/**
 * Created by PhpStorm.
 * Filename: cargar_estados.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 15/08/2024
 * Time: 6:29 p. m.
 */
?>
<select name="departamento" id="select_estado" class="form-control">
    @foreach($estados as $estado)
        {{--Para aprovechar la relacion se toma el id del estado en la tabla--}}
        <option value="{{$estado->id}}">{{$estado->name}}</option>
    @endforeach
</select>
