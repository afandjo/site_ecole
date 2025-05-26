<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'eleve_id',
        'enseignant_id',
        'matiere_id',
        'interrogation_1',
        'interrogation_2',
        'interrogation_3',
        'devoir',
        'composition',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

}

