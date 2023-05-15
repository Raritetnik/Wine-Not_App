<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille_Par_Cellier extends Model
{
    use HasFactory;

    protected $table = 'bouteille_par_celliers';
    protected $fillable = [
        'date_achat',
        'garde_jusqua',
        'prix',
        'quantite',
        'vino_cellier_id',
        'vino_bouteille_id',
        'millesime',
        'utilisateurs_id'
    ];

    public function vino_bouteille()
    {
        return $this->belongsTo(Vino_bouteille::class, 'vino_bouteille_id');
    }



    public function vino_cellier()
    {
        return $this->belongsTo(Vino_Cellier::class, 'vino_cellier_id');
    }
}
