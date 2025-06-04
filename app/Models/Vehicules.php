<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicules extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'immatriculation',
        'annee',
        'kilometrage',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
