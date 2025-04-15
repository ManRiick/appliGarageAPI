<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Factures;
use App\Models\Vehicules;

class Taches extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'description',
        'prix',
        'duree_jour',
        'vehicule_id',
        'statut',
    ];
    protected $table = 'taches';
    public function vehicule()
    {
        return $this->belongsTo(Vehicules::class, 'vehicule_id');
    }
   
}