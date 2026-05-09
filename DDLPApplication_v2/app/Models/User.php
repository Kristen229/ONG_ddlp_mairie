<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserGroup;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'groupe',
        'name',
        'domaine',
        'denomination',
        'date',
        'objectif1',
        'objectif2',
        'objectif3',
        'siege',
        'email',
        'number1',
        'number2',
        'attachment',
        'identifiant',
        'password',
        'lien',
        'name_president',
        'last_name_president',
        'attachment1',
        'name_vice_president',
        'last_name_vice_president',
        'attachment2',
        'name_secretaire_general',
        'last_name_secretaire_general',
        'attachment3',
        'name_tresorier_general',
        'last_name_tresorier_general',
        'attachment4',
        'attachment5',
        'signature_data',
        'cachet',
        'created_by',
        'is_approved',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'groupe' => UserGroup::class,
            'date' => 'date',
            'is_approved' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }

    // ---- Relations ----

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function requests()
    {
        return $this->hasMany(AssociationRequest::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
