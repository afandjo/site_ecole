<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'age',
        'classe',
        'etablissement_prevenance',
        'numero_table_cepd',
        'moyenne_cepd',
        'moyenne_trimestre_1',
        'moyenne_trimestre_2',
        'moyenne_trimestre_3',
        'code_acces',
    ];
    public function notes() {
        return $this->hasMany(Note::class);
    }

}

