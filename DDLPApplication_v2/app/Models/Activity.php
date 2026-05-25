<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EvaluationStatus;

class Activity extends Model
{
    use HasFactory;

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
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'actual_date' => 'date',
            'is_visible' => 'boolean',
            'budget_expected' => 'float',
            'budget_actual' => 'float',
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
