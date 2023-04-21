<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vino_Format extends Model
{
    use HasFactory;

    protected $table = 'vino_formats';
    protected $fillable = [
        'format'
    ];
}
