<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'adresse',
        'phone',
        'date_de_naissance',
        'ville_id', 
        'user_id'
    ];
}
