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
        'budget_expected',
        'budget_actual',
        'actual_date',
        'evaluation_status',
        'evaluation_comment',
        'score',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'actual_date' => 'date',
            'evaluation_status' => EvaluationStatus::class,
            'is_visible' => 'boolean',
            'score' => 'float',
            'budget_expected' => 'float',
            'budget_actual' => 'float',
        ];
    }

    // ---- Relations ----

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
