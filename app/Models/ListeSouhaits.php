<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeSouhaits extends Model
{
    use HasFactory;

    protected $table = 'liste_souhaits';

    protected $fillable = [
        'utilisateurs_id',
        'vino_bouteilles_id'
    ];
}
