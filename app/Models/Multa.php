<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
protected $fillable = ['departamento', 'monto', 'motivo', 'fecha'];
}
