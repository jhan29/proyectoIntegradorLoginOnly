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
                    <label for="id_cliente">Numero Documento Del Cliente</label>
                        <select name="id_cliente"  class="form-control selectpicker" data-live-search="true">
                            @foreach($clientes as $cli)
                            @if($cli->id_cliente == $vehiculo->id_cliente)
                            <option value="{{$cli->id_cliente}}" selected >Numero Documento: {{$cli->num_documento}} Nombre: {{$cli->nombre}} Apellido: {{$cli->apellido}}</option>
                            @else
                            <option value="{{$cli->id_cliente}}" disabled >Numero Documento: {{$cli->num_documento}} Nombre: {{$cli->nombre}} Apellido: {{$cli->apellido}}</option>
                            @endif
                            @endforeach          
                        </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="tipo_vehiculo">Tipo De Vehiculo</label>
                        <select name="tipo_vehiculo" id="tipo_vehiculo"  class="form-control selectpicker" data-live-search="true">
                            @if($vehiculo->tipo_vehiculo=='Automovil')
                            <option value="{{$vehiculo->tipo_vehiculo}}" selected >{{$vehiculo->tipo_vehiculo}}</option>
                            <option value="Moticicleta" disabled >Moticicleta</option>
                            <option value="Buseta" disabled >Buseta</option>
                            @elseif ($vehiculo->tipo_vehiculo=='Motocicleta')
                            <option value="Automovil" disabled >Automovil</option>
                            <option value="{{$vehiculo->tipo_vehiculo}}" selected >{{$vehiculo->tipo_vehiculo}}</option>
                            <option value="Buseta" disabled >Buseta</option>
                            @elseif ($vehiculo->tipo_vehiculo=='Buseta')
                            <option value="Automovil" disabled >Automovil</option>
                            <option value="Moticicleta" disabled >Moticicleta</option>
                            <option value="{{$vehiculo->tipo_vehiculo}}" selected >{{$vehiculo->tipo_vehiculo}}</option>
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="placa_vehiculo">Placa Del Vehiculo</label>
                    <input type="text" name="placa_vehiculo" id="placa_vehiculo" class="form-control" value="{{$vehiculo->placa_vehiculo}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="marca_vehiculo">Marca Del Vehiculo</label>
                    <input type="text" name="marca_vehiculo" id="marca_vehiculo" class="form-control" value="{{$vehiculo->marca_vehiculo}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="modelo_vehiculo">Modelo Del Vehiculo</label>
                    <input type="text" name="modelo_vehiculo" id="modelo_vehiculo" class="form-control" value="{{$vehiculo->modelo_vehiculo}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="color_vehiculo">Color Del Vehiculo</label>
                    <input type="text" name="color_vehiculo" id="color_vehiculo" class="form-control" value="{{$vehiculo->color_vehiculo}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="num_puertas">Numero De Puertas</label>
                    <input type="number" name="num_puertas" id="num_puertas" class="form-control" value="{{$vehiculo->num_puertas}}">
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
