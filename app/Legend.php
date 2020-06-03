<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legend extends Model
{
    protected $fillable = ['saleId', 'code', 'value'];
}
