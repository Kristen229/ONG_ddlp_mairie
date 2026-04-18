<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'groupe', 'name', 'domaine', 'denomination', 'date', 'objectif1', 
        'objectif2', 'objectif3', 'siege', 'email', 'number1', 'number2', 
        'attachment', 'identifiant', 'password', 'lien', 'namePresident', 
        'lastNamePresident', 'attachment1', 'nameVicePresident', 
        'lastNameVicePresident', 'attachment2', 'nameSecretaireGeneral', 
        'lastNameSecretaireGeneral', 'attachment3', 'nameTresorierGeneral', 
        'lastNameTresorierGeneral', 'attachment4', 'attachment5', 'signature_data', 'cachet', 'created_by',
    ];

    // Ajoutez d'autres méthodes ou propriétés si nécessaire
    protected $hidden = ['password', 'remember_token'];
   
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    
}
