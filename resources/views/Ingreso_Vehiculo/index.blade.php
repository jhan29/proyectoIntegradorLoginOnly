@extends ('layouts.layout')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ingreso De Vehiculos Al Parqueadero <a href="ingreso_vehiculo/create">
                <button class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a></h3>
                @include('Ingreso_Vehiculo.search')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Id Ingreso</th>
                        <th>Fecha Ingreso</th>
                        <th>Usuario</th>
                        <th>Vehiculo</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    @if($ingresos->count())
                    @foreach ($ingreso as $in)
                    <tr>
                        <td>{{$in->id_ingreso}}</td>
                        <td>{{$in->fecha_ingreso}}</td>
                        <td>Id: {{auth()->user()->id}} - Nombre: {{auth()->user()->name}}</td>
                        <td>ID: {{$in->vehiculos->id_vehiculo}} Placa: {{$in->vehiculos->placa}}</td>
                        <td>{{$in->estado}}</td>                  
                    <td>
                        <!--<a href="{{URL::action('Ingreso_VehiculoController@edit',$in->id_ingreso)}}"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar </button></a>-->
                        <a href="" data-target="#modal-delete-{{$in->id_ingreso}}" data-toggle="modal"><button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Eliminar </button></a>
                    </td>
                    </tr>
                    @include('Ingreso_Vehiculo.modal')
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">No hay registro de vehiculos ingresados al parqueadero !!</td>
                    </tr>
                    @endif
                </table>
            </div>
            {{$ingresos->render()}}
        </div>
    </div>
@endsection
