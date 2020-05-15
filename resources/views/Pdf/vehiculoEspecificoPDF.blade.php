<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Vehiculo Especifico | SivWeb Online</title>
    </head>
    <body>

        <div class="container">


            <h3 class="text-center">Reporte De Vehiculo</h3>
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
                        <th>Vehiculo Numero:</th>
                        <th>Tipo Vehiculo:</th>
                        <th>Placa:</th>
                    </tr>
                        <tr>                        
                            <td>{{$idvehiculo}}</td>
                            <td>ID: {{$tipovehiculoid}} Nombre:{{$tiponombre}}</td>
                            <td>{{$placavehiculo}}</td>
                        </tr>
                </table>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h5 class="text-center">Usuario: {{auth()->user()->name}}</h5>
            <h6 align="center">SET Ingenieria, software de ventas version 1</h6>
        </div>
    </body>
</html>