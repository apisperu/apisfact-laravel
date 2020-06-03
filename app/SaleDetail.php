<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = ['saleId', 'productId', 'cantidad', 'mtoValorVenta', 'mtoBaseIgv', 'porcentajeIgv', 'igv', 'tipAfeIgv', 'totalImpuestos', 'mtoPrecioUnitario'];
}
