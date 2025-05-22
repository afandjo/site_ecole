<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Enseignant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom', 'prenoms', 'email', 'matiere', 'telephone', 'code',
    ];
    public function notes()
{
    return $this->hasMany(Note::class);
}

}

