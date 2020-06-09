@extends ('layouts.layout')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Imprimir Vehiculos Retirados</h3>
        <a href="\imprimirVehiculosRetirados">
        <button class="btn btn-success">
            <span class="glyphicon glyphicon-download-alt">
            </span> Generar Reporte general</button></a>
            <p></p>
            <!--<h3>Listado De Salida De Vehiculos <a href="salida_vehiculo/create">
                <button class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a></h3>-->
            <br>
            @include('Salida_Vehiculo.search')
            <br>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id Ingreso</th>
                    <th>Fecha_Ingreso</th>
                    <th>Placa</th>
                    <th>Nombre</th>
                    <th>Valor * Hora</th>
                    <th>Opciones</th>
                </thead>

                @foreach ($Salida_vehiculos as $salida)<tr>
                    <td>{{ $salida->id_ingreso}}</td>
                    <td>{{ $salida->fecha_ingreso}}</td>
                    <td>{{ $salida->placa}}</td>
                    <td>{{ $salida->nombre}}</td>
                    <td>${{number_format($salida->valor_hora)}}</td>
                    <td>
                    <a href="{{route('Salida_vehiculos',[$salida->placa,$salida->id_ingreso,$salida->valor_hora])}}">
                        <button class="btn btn-info"><span class=" glyphicon glyphicon-usd"></span>Retirar Vehiculo</button></a>
                        
                    </td>

                </tr>@endforeach
            </table>
        </div>
        {{$Salida_vehiculos->render()}}
    </div>
</div>
@endsection