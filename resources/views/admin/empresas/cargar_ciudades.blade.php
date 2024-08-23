<?php
/**
 * Created by PhpStorm.
 * Filename: cargar_ciudades.blade.php
 * Descr: Archivo PHP del Proyecto sistemadeventas Producto PhpStorm
 * User: IngEnLinea https://ingenlinea.com/ INGENLINEAPC
 * Date: 20/08/2024
 * Time: 1:38 p. m.
 */
?>
<select name="ciudad" id="select_ciudad" class="form-control">
    @foreach($ciudades as $ciudade)
        {{--Para aprovechar la relacion se toma el id del estado en la tabla--}}
        <option value="{{$ciudade->id}}">{{$ciudade->name}}</option>
    @endforeach
</select>
