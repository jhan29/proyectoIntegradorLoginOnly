@extends ('layouts.layout')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Tarifa</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
            {!!Form::open(array('url'=>'tarifa','method'=>'POST','autocomplete'=>'off'))!!}
                {{Form::token()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="id_tarifa">Tarifa Numero:</label>
                                <input type="number" name="id_tarifa" class="form-control" value="{{$idtarifa}}" value="{{ old('id_tarifa') }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <br>
                            <label for="tipo_vehiculo_id_tipo ">Tipo De Vehiculo, Asignar :</label>
                            <select type="text" name="tipo_vehiculo_id_tipo" id="tipo_vehiculo_id_tipo" value="{{ old('tipo_vehiculo_id_tipo') }}" class="form-control selectpicker" data-live-search="true" data-header="Listado De Los Tipos De Vehiculos">
                                <option value="" disable>Seleccione El Tipo De Vehiculo:</option>
                                @foreach($idtipovehiculo as $tipo)
                                <option value="{{$tipo->id_tipo}}">ID :{{$tipo->id_tipo}} Nombre:{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="valor">Valor Tarifa * Hora: </label>
                                <input type="number" name="valor" id="valor" value="{{ old('valor') }}" class="form-control" placeholder="Digite El Valor De La Tarifa * Hora...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="fecha_inicio">Fecha Inicio Tarifa: </label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="fecha_fin">Fecha Final Tarifa: </label>
                                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}" class="form-control" >
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
                                <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
                                <a class="btn btn-info" type="reset" href="{{url('tarifa')}}"><span class="glyphicon glyphicon-home"></span> Regresar </a>
                        </div>
                    </div>
                </div>
                                      
            {!!Form::close()!!}       
@endsection