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
        'objectifs',
        'commune',
        'arrondissement',
        'quartier',
        'maison',
        'email',
        'number1',
        'number2',
        'lien',
        'logo_path',
        'recepisse_path',
        'journal_officiel_path',
        'attestation_path',
        'reglement_path',
        'identifiant',
        'password',
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
            'objectifs' => 'array',
            'domaine' => 'array',
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

    public function boardMembers()
    {
        return $this->hasMany(BoardMember::class);
    }
}
