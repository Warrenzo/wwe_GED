<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content', // Optionnel si vous avez du texte en plus du fichier
        'file_path', // Stocke le chemin vers le fichier importé
        'classification_id', // Associe le document à une classification ou sous-classification
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
}

