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

    public function domaines()
    {
        return $this->belongsToMany(Domaine::class)->withTimestamps();
    }

    public function boardMembers()
    {
        return $this->hasMany(BoardMember::class);
    }

    public function getDomaineAttribute(): string
    {
        $domaines = $this->relationLoaded('domaines')
            ? $this->domaines
            : $this->domaines()->get();

        return $domaines->pluck('nom')->implode(', ');
    }

    public function syncDomainesByNames(array $names): void
    {
        $ids = collect($names)
            ->filter(fn ($name) => is_string($name) && trim($name) !== '')
            ->map(fn ($name) => trim($name))
            ->unique()
            ->map(fn ($name) => Domaine::firstOrCreate(['nom' => $name])->id)
            ->all();

        $this->domaines()->sync($ids);
    }
}
