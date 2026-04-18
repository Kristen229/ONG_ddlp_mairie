<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests'; // Table associée

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function countPendingRequests()
    {
        return self::where('statut', 'En attente')->count();
    }


}
