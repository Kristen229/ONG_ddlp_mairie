<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Attributs modifiables
    protected $fillable = ['title', 'message', 'recipient_name', 'recipient_email', 'user_id',];

    // Définir la table associée si nécessaire
    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
