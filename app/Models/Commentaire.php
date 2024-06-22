<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_utilisateur',
        'ID_note',
        'Contenu',
        'Date',
        'rating'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'ID_utilisateur');
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'ID_note');
    }
}