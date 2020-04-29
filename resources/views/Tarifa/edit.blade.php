@extends ('layouts.layout')
@section('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Editar Tarifa {{$tarifa->id_tarifa}}</h3>
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

    {{Form::open(array('action'=>array('TarifaController@update', $tarifa->id_tarifa),'method'=>'patch'))}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="id_tarifa">Vehiculo Numero:</label>
                    <input type="number" name="id_tarifa" class="form-control" value="{{$tarifa->id_tarifa}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="tipo_vehiculo_id_tipo">Tipo De Vehiculo</label>
                        <select name="tipo_vehiculo_id_tipo" id="tipo_vehiculo_id_tipo"  class="form-control selectpicker" data-live-search="true">
                            @foreach ($tipovehiculo as $tipo)
                                @if($tipo->id_tipo == $tarifa->tipo_vehiculo_id_tipo)
                                    <option value="{{$tarifa->tipo_vehiculo_id_tipo}}" selected >Nombre: {{$tipo->nombre}}</option>
                                @else
                                    <option value="{{$tarifa->tipo_vehiculo_id_tipo}}" disabled >Nombre: {{$tipo->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="valor">Valor Hora</label>
                    <input type="number" name="valor" id="valor" class="form-control" value="{{$tarifa->valor}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{$tarifa->fecha_inicio}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha_fin">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{$tarifa->fecha_fin}}">
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
