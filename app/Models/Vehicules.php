<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicules extends Model
{
    protected $fillable = [
        'marque', 'modele', 'immatriculation', 'annee', 'kilometrage', 'user_id'];

    // Un véhicule appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un véhicule a plusieurs tâches
    public function taches()
    {
        return $this->hasMany(Taches::class);
    }

}
