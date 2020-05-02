@extends ('layouts.layout')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado De Las Tarifas <a href="tarifa/create">
                <button class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Crear Tarifa</button></a></h3>
                
                @include('Tarifa.search')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Id Tarifa</th>
                        <th>Tipo Vehiculo Asignar Tarifa</th>
                        <th>Valor Hora</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    @if($tarifas->count())
                    @foreach ($tarifa as $ta)
                    <tr>
                        <td>{{$ta->id_tarifa}}</td>
                        <td>ID : {{$ta->tipo_vehiculos->id_tipo}} - Nombre :{{$ta->tipo_vehiculos->nombre}}</td>
                        <td>{{$ta->valor_hora}}</td>
                        <td>{{$ta->estado}}</td>                  
                    <td>
                        <a href="{{URL::action('TarifaController@edit',$ta->id_tarifa)}}"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar Tarifa </button></a>
                        <a href="" data-target="#modal-delete-{{$ta->id_tarifa}}" data-toggle="modal"><button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Inactivar Tarifa </button></a>
                    </td>
                    </tr>
                    @include('Tarifa.modal')
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">No hay registro de tarifas !!</td>
                    </tr>
                    @endif
                </table>
            </div>
            {{$tarifas->render()}}
        </div>
    </div>
@endsection
