@extends ('layouts.layout')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Vehiculo</h3>
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
            {!!Form::open(array('url'=>'vehiculo','method'=>'POST','autocomplete'=>'off'))!!}
                {{Form::token()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="id_vehiculo">Vehiculo Numero:</label>
                                <input type="number" name="id_vehiculo" class="form-control" value="{{$idvehiculo}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <br>
                            <label for="id_cliente">Documento Del Cliente:</label>
                            <select type="number" name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true" data-header="Listado De Clientes">
                                <option value="" disable>Seleccione EL Documento Del Cliente:</option>
                                @foreach($clientes as $cli)   
                                <option value="{{$cli->id_cliente}}">Numero Documento: {{$cli->num_documento}} Nombre: {{$cli->nombre}} Apellido: {{$cli->apellido}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <br>
                            <label for="tipo_vehiculo">Tipo De Vehiculo</label>
                            <select type="text" name="tipo_vehiculo" id="tipo_vehiculo" class="form-control selectpicker" data-live-search="true" data-header="Listado De Los Tipos De Vehiculos">
                                <option value="" disable>Seleccione El Tipo De Vehiculo:</option>
                                <option value="Automovil">Automovil</option>
                                <option value="Motocicleta">Motocicleta</option>
                                <option value="Buseta">Buseta</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="placa_vehiculo">Placa Del Vehiculo</label>
                                <input type="text" name="placa_vehiculo" id="placa_vehiculo" class="form-control" placeholder="Digite La Placa Del Vehiculo...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="marca_vehiculo">Marca Del Vehiculo</label>
                                <input type="text" name="marca_vehiculo" class="form-control" placeholder="Digite La Marca Del Vehiculo...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="modelo_vehiculo">Modelo Del Vehiculo</label>
                                <input type="text" name="modelo_vehiculo" class="form-control" placeholder="Digite El Modelo Del Vehiculo...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="color_vehiculo">Color Del Vehiculo</label>
                                <input type="text" name="color_vehiculo" class="form-control" placeholder="Digite El Color Del Vehiculo...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <label for="num_puertas">Numero De Puertas</label>
                                <input type="number" name="num_puertas" class="form-control" placeholder="Digite La Cantidad De Puertas Del Vehiculo...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <br>
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
                                <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
                                <a class="btn btn-info" type="reset" href="{{url('vehiculo')}}"><span class="glyphicon glyphicon-home"></span> Regresar </a>
                        </div>
                    </div>
                </div>
                                      
            {!!Form::close()!!}       
@endsection