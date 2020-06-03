<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['descripcion', 'codProducto', 'unidad', 'mtoValorUnitario', 'companyRuc'];
}
