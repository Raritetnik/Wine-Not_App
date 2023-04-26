<?php

namespace App\Models;
use App\Models\User;
use App\Models\Bouteille_Par_Cellier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vino_Cellier extends Model
{
    use HasFactory;

    protected $table = 'vino_celliers';
    use HasFactory;
    protected $fillable = [
        'nom',
        'quantite_max',
        'description',
        'image',
        'utilisateurs_id',
    ];

    // etablir les relations entre les tables dans la base de donnees
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function bottles()
    {
        return $this->hasMany(Bouteille_Par_Cellier::class);
    }

}


