<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'nom',
        'prenom',
        'telephone',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
