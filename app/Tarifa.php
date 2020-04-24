<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table='tarifa';

    protected $primaryKey='id_tarifa';
  
    public $timestamps=false;
    protected $fillable = ['tipo_vehiculo_id_tipo',	'valor', 'fecha_inicio', 'fecha_fin'];

    public function tipo_vehiculo()
    {
        return $this->belongsTo('App\Tipo_Vehiculo');
    }
}

