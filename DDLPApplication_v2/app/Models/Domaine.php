<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    public const DEFAULT_NAMES = [
        "Sport de masse et d'animation (tournois locaux, maracana, football, basketball)",
        "Sport au féminin (promotion du sport chez les filles, lutte contre les stéréotypes)",
        "Sport-Loisir et Fitness (clubs de marche, gymnastique d'entretien, bien-être)",
        "Handisport (pratique sportive adaptée aux personnes en situation de handicap)",
        "Infrastructures sportives (aménagement de terrains de proximité, dons d'équipements)",
        "Enseignement primaire et secondaire (construction de classes, dons de fournitures, parrainages)",
        "Éducation des filles (maintien à l'école, lutte contre le décrochage précoce)",
        "Alphabétisation des adultes (cours de lecture/écriture en langues nationales : Fon, Adja, Yoruba...)",
        "Formation professionnelle (appui aux apprentis en couture, coiffure, mécanique, soudure)",
        "Soutien scolaire et Excellence (cours de renforcement, bibliothèques, prix d'excellence)",
        "Santé maternelle et infantile (suivi des grossesses, accouchements sécurisés, vaccination)",
        "Lutte contre les maladies (prévention du paludisme, du VIH/SIDA, des IST, du diabète)",
        "Santé sexuelle des jeunes (contraception, gestion des menstrues, éviter les grossesses précoces)",
        "Nutrition communautaire (lutte contre la malnutrition des enfants, bouillies enrichies)",
        "Santé mentale (prise en charge et déstigmatisation des troubles psychiques)",
        "Protection de l'enfance (lutte contre le trafic d'enfants/Vidomégons, la maltraitance)",
        "Droits des femmes et VBG (assistance juridique et écoute pour les victimes de violences)",
        "Droits des détenus (amélioration des conditions de vie en prison, réinsertion)",
        "Inclusion sociale (défense des droits des personnes marginalisées ou handicapées)",
        "Microfinance et Épargne (groupements d'épargne type AVEC pour l'autonomie des femmes)",
        "Agriculture et Maraîchage (appui technique aux producteurs, agroécologie, semences résilientes)",
        "Transformation locale (modernisation de la production de gari, huile de palme, beurre de karité)",
        "Entrepreneuriat des jeunes (incubateurs, aide à la création de micro-entreprises, kits d'installation)",
        "Eau potable (WASH) (forages, puits, gestion des points d'eau villageois)",
        "Assainissement et Déchets (collecte des ordures, salubrité publique, latrines scolaires)",
        "Biodiversité et Nature (protection des mangroves, zones humides, forêts sacrées, parcs)",
        "Changement climatique (reboisement, lutte contre l'érosion côtière, foyers améliorés)",
        "Gouvernance locale (contrôle citoyen de l'action publique, veille sur les budgets des mairies)",
        "Éducation civique (sensibilisation aux droits et devoirs, culture de la paix)",
        "Art et Patrimoine (valorisation des danses traditionnelles, artisanat d'art, festivals)",
        "Tourisme communautaire (écotourisme géré par les populations villageoises)",
        "Inclusion numérique (alphabétisation digitale, initiation informatique en milieu rural)",
    ];

    protected $fillable = [
        'nom',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
