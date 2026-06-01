<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'actor_type',
        'actor_id',
        'actor_name',
        'action',
        'description',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public static function record(string $action, ?string $description = null, array $metadata = []): void
    {
        $admin = auth('admin')->user();
        $user = auth()->user();
        $actor = $admin ?: $user;

        static::create([
            'actor_type' => $admin ? 'admin' : ($user ? 'user' : 'system'),
            'actor_id' => $actor?->id,
            'actor_name' => $actor
                ? trim(($actor->prenom ?? '') . ' ' . ($actor->nom ?? '')) ?: ($actor->name ?? $actor->email)
                : null,
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata ?: null,
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);
    }
}
