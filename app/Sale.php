<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['tipoOperacion', 'tipoDoc', 'serie', 'correlativo', 'fechaEmision', 'tipoMoneda', 'clientId', 'companyRuc', 'companyRazonSocial', 'companyDireccion', 'mtoOperGravadas', 'mtoIGV', 'totalImpuestos', 'valorVenta', 'mtoImpVenta', 'ublVersion', 'sunatResponse'];
}
