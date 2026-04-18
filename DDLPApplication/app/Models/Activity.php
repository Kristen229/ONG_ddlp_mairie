<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 
        'description', 
        'lieu', 
        'date', 
        'attachment', 
        'user_id', // Ajoutez ici les autres champs nécessaires
        'beneficiaries_expected',
        'beneficiaries_actual',
        'budget_expected',
        'budget_actual',
        'actual_date',
        'evaluation_status',
        'evaluation_comment',
        'score',
    ];

    protected $table = 'activities';  // Assurez-vous que le nom de la table est correct


    public function user()
{
    return $this->belongsTo(User::class);
}

}

