
@extends ('layouts.layout')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado De Usuario Con Asignacion De Rol <a  href="usuario_role/create"><button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Asignar Rol Al Usuario</button></a></h3>
       	@include('User_Role.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
				    <th>Id</th>
					<th>Usuario</th>
				    <th>Rol Del Usuario</th>
				</thead>
                @foreach($user_role as $ur)
				<tr>
				    <td>{{$ur->id}}</td>
					<td>{{$ur->name}}</td>
					<td>{{$ur->description}}</td>
					<td>
					   <a href="" data-target="#modal-delete-{{$ur->id}}" data-toggle="modal"><button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Eliminar</button></a>
				   </td>
				</tr>
				@include('User_Role.modal')
				@endforeach
			</table>
		</div>
		{{$user_role->render()}}
	</div>
</div>

@endsection
