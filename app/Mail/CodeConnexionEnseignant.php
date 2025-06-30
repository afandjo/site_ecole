<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeConnexionEnseignant extends Mailable
{
    use Queueable, SerializesModels;

    public $enseignant;

    public function __construct($enseignant)
    {
        $this->enseignant = $enseignant;
    }

    public function build()
    {
        return $this->from('tekorolandafandjo94@gmail.com', 'École Sainte Azor')
            ->subject('Validation de votre enregistrement')
            ->markdown('emails.code_connexion')
            ->with('enseignant', $this->enseignant);
    }
}
