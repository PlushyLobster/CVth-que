<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule', 
        'description',
        'slug'
    ];

    /*
    * Une compétence (model) est partagée par plusieurs (belongsToMany) professionnels
    * Récupération de tous les professionnels qui ont telle ou telles compétence(s)
    * -> withTimestamps() pour la gestion des propriétés appartenant à la relation
    */
    public function professionnels()
    {
        return $this->belongsToMany(Professionnel::class)->withTimestamps();
    }

}
