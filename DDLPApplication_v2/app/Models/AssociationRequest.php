<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RequestStatus;

class AssociationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'location',
        'statut',
        'pdf_path',
        'destinataire',
        'motif',
        'reference',
        'objet',
        'attachment',
        'admin_response',
        'admin_attachment',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'statut' => RequestStatus::class,
        ];
    }

    // ---- Relations ----

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ---- Scopes ----

    public static function countPending(): int
    {
        return self::where('statut', RequestStatus::PENDING)->count();
    }
}
