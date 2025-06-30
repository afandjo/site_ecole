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
    protected $casts = [
    'inscription_validee' => 'boolean',
    'inscription_en_cours' => 'boolean',
    'tranche1_validee' => 'boolean',
    'tranche2_validee' => 'boolean',
    'tranche3_validee' => 'boolean',
];

    public function notes() {
        return $this->hasMany(Note::class);
    }

public function getMoyenneAnnuelleAttribute()
{
    if (is_null($this->moyenne_trimestre_1) || is_null($this->moyenne_trimestre_2) || is_null($this->moyenne_trimestre_3)) {
        return null;
    }

    $somme = $this->moyenne_trimestre_1 + $this->moyenne_trimestre_2 + $this->moyenne_trimestre_3;
    return round($somme / 3, 2);
}



}

