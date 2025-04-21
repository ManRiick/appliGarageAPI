<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vehicules extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'marque',
        'modele',
        'immatriculation',
        'annee',
        'kilometrage',
        'user_id',
    ];
    protected $table = 'vehicules';
}
