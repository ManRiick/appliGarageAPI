<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Vehicules;
use App\Models\Taches;

class Factures extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'date_facture',
        'description',
        'tache_id',
        'vehicule_id',
        'user_id',
        'montant_total',
        'statut_payement',
    ];
    protected $table = 'factures';
    public function vehicule()
    {
        return $this->belongsTo(Vehicules::class, 'vehicule_id');
    }
    public function tache()
    {
        return $this->belongsTo(Taches::class, 'tache_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
