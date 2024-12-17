<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'prenom',
        'nom',
        'cp',
        'ville',
        'telephone',
        'email',
        'cv',
        'naissance',
        'formation',
        'domaine',
        'source',
        'observation',
        'metier_id'
    ];
    function metier()
    {
        return $this->belongsTo(Metier::class);
    }

        /*
    * Un professionnel (model) est partagé par plusieurs (belongsToMany) compétences
    * Récupération de toutes les compétences qui ont telle ou telles professionnel(s)
    * -> withTimestamps() pour la gestion des propriétés appartenant à la relation
    */
    function competences()
    {
        return $this->belongsToMany(Competence::class)->withTimestamps();
    }

}
