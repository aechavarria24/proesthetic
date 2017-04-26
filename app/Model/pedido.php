<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
  public $table = "pedido";

  protected $fillable = [
    'usuario_id', 'servicio_tipoContrato_id', 'descripcion',
     'fechaEntrega', 'paciente_id', 'empleado_id', 'estado_pedido_id','valor','observacion'
  ];

}
