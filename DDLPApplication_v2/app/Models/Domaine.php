<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    public const DEFAULT_NAMES = [
        "Agriculture et Maraîchage",
        "Alphabétisation des adultes",
        "Art et Patrimoine",
        "Assainissement et Déchets",
        "Biodiversité et Nature",
        "Changement climatique",
        "Droits des détenus",
        "Droits des femmes et VBG",
        "Eau potable (WASH)",
        "Éducation civique",
        "Éducation des filles",
        "Enseignement primaire et secondaire",
        "Entrepreneuriat des jeunes",
        "Formation professionnelle",
        "Gouvernance locale",
        "Handisport",
        "Inclusion numérique",
        "Inclusion sociale",
        "Infrastructures sportives",
        "Lutte contre les maladies",
        "Microfinance et Épargne",
        "Nutrition communautaire",
        "Protection de l'enfance",
        "Santé maternelle et infantile",
        "Santé mentale",
        "Santé sexuelle des jeunes",
        "Soutien scolaire et Excellence",
        "Sport au féminin",
        "Sport de masse et d'animation",
        "Sport-Loisir et Fitness",
        "Tourisme communautaire",
        "Transformation locale",
        "Autre",
    ];

    protected $fillable = [
        'nom',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
