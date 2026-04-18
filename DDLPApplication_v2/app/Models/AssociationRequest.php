<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RequestStatus;

class AssociationRequest extends Model
{
    use HasFactory;

    protected $table = 'association_requests';

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'location',
        'status',
        'pdf_path',
        'destinataire',
        'reference',
    ];

    protected function casts(): array
    {
        return [
            'status' => RequestStatus::class,
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
        return self::where('status', RequestStatus::PENDING)->count();
    }
}
