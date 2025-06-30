@component('mail::message')
# Introduction

Travail Fidélité et Reussite.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Félicitations {{ $enseignant->nom }} {{ $enseignant->prenoms }} !

Votre enregistrement a été effectué avec succès.

Voici votre **code de connexion** :
**`{{ $enseignant->code }}`**

Veuillez vous connecter à la plateforme avec ce code.

Merci,<br>
L’équipe de l’administration
@endcomponent
