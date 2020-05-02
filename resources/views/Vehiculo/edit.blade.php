@extends ('layouts.layout')
@section('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Editar Vehiculo {{$vehiculo->id_vehiculo}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)

                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    {{Form::open(array('action'=>array('VehiculoController@update', $vehiculo->id_vehiculo),'method'=>'patch'))}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="id_vehiculo">Vehiculo Numero:</label>
                    <input type="number" name="id_vehiculo" class="form-control" value="{{$vehiculo->id_vehiculo}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="tipo_vehiculo_id_tipo">Tipo De Vehiculo</label>
                        <select name="tipo_vehiculos_id_tipo" id="tipo_vehiculos_id_tipo"  class="form-control selectpicker" data-live-search="true">
                            @foreach ($tipovehiculo as $tipo)
                                @if($tipo->id_tipo == $vehiculo->tipo_vehiculos_id_tipo)
                                    <option value="{{$vehiculo->tipo_vehiculos_id_tipo}}" selected >Nombre: {{$tipo->nombre}}</option>
                                @else
                                <option value="{{$vehiculo->tipo_vehiculos_id_tipo}}"  >Nombre: {{$tipo->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="placa">Placa Del Vehiculo</label>
                    <input type="text" name="placa" id="placa" pattern="[A-Z]{3}[0-9]{3}|[A-Z]{3}[0-9]{2}[A-Z]" class="form-control" value="{{$vehiculo->placa}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-refresh"></span> Actualizar </button>
                    <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-repeat"></span> Vaciar Campos</button>
                    <a class="btn btn-info" type="reset" href="{{url('vehiculo')}}"><span class="glyphicon glyphicon-home"></span> Regresar </a>
                </div>   
            </div>
        </div>
	{{Form::close()}}

@endsection
