<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculationHistory extends Model
{
   protected $fillable = [
    'user_name',
    'formula',
    'result',
    'type'
];
}
