<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Vehiculos | SivWeb Online</title>
    </head>
    <body>

        <div class="container">


            <h3 class="text-center">Reporte De Los Vehiculos</h3>
                <img align="right" src="" alt="" width='100px'>
            <br>
            <br>
                <h1 class="text-center">Ferro Miscelanea La 53</h1>
                <h3 class="text-center">NIT: 53625748-1</h3>
                <h3 class="text-center">Tel. 44463267</h3>
            <br>
            <br>
            <br>

                <table class="table table-bordered table-striped table-hover">

                    <tr>
                        <th>Datos</th>
                        <th>Numero Documento</th>
                        <th>Nombre Cliente</th>
                        <th>Apellido Cliente</th>
                        <th>Tipo Vehiculo</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Numero Puertas</th>
                    </tr>

                    <?php

                    foreach($vehiculos as $ve){?>
                        <tr>
                            <td>{{'Vehiculo# : ' .$ve->id_vehiculo. ' Cliente# : ' .$ve->id_cliente}}</td>
                            <td>{{$ve->num_documento}}</td>
                            <td>{{$ve->nombre}}</td>
                            <td>{{$ve->apellido}}</td>                           
                            <td>{{$ve->tipo_vehiculo}}</td>
                            <td>{{$ve->placa_vehiculo}}</td>
                            <td>{{$ve->marca_vehiculo}}</td>
                            <td>{{$ve->modelo_vehiculo}}</td>
                            <td>{{$ve->color_vehiculo}}</td>
                            <td>{{$ve->num_puertas}}</td>
                        </tr>
                        <?php   }?>

                </table>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h6 align="center">SET Ingenieria, software de ventas version 1</h6>
        </div>
    </body>
</html>