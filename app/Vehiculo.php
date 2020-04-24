<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table='vehiculo';

    protected $primaryKey='id_vehiculo';
  
    public $timestamps=false;
    protected $fillable = ['id_cliente', 'tipo_vehiculo','placa_vehiculo', 'marca_vehiculo', 'modelo_vehiculo', 'color_vehiculo', 'num_puertas'];
}
