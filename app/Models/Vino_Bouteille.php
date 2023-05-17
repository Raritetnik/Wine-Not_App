<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vino_Bouteille extends Model
{
    use HasFactory;

    protected $table = 'vino_bouteilles';
    protected $fillable = [
        'nom',
        'image',
        'code_saq',
        'description',
        'prix_saq',
        'url_saq',
        'url_img',
        'vino_format_id',
        'vino_type_id',
        'pays_id',
        'utilisateur_id'
    ];


    public function bouteille_par_celliers()
    {
        return $this->hasMany(Bouteille_Par_Cellier::class, 'vino_bouteille_id');
    }
    


    public function vinoFormat()
    {
        return $this->belongsTo(Vino_Format::class, 'vino_format_id');
    }

    public function vinoType()
    {
        return $this->belongsTo(Vino_Type::class, 'vino_type_id');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }

}
