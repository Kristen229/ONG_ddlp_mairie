<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Activity extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_CORRECTION_REQUESTED = 'correction_requested';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'lieu',
        'date',
        'attachment',
        'beneficiaries_expected',
        'beneficiaries_actual',
        'target_audience',
        'budget_expected',
        'budget_actual',
        'actual_date',
        'is_visible',
        'status',
        'correction_count',
        'last_admin_feedback',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'actual_date' => 'date',
            'is_visible' => 'boolean',
            'budget_expected' => 'float',
            'budget_actual' => 'float',
            'correction_count' => 'integer',
        ];
    }

    // ---- Relations ----

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
