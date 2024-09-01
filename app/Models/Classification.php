<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name', 
        'parent_id'
    ];

    /**
     * Relation avec la classification parente.
     * 
     * Une classification peut avoir une seule classification parente.
     */
    public function parent()
    {
        return $this->belongsTo(Classification::class, 'parent_id');
    }

    /**
     * Relation avec les sous-classifications.
     * 
     * Une classification peut avoir plusieurs sous-classifications (enfants).
     */
    public function children()
    {
        return $this->hasMany(Classification::class, 'parent_id');
    }

    /**
     * Relation avec les documents.
     * 
     * Une classification peut avoir plusieurs documents associés.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Vérifie si une classification a des enfants.
     * 
     * @return bool
     */
    public function hasChildren()
    {
        return $this->children()->exists();
    }

    /**
     * Récupère toutes les sous-classifications de manière récursive.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allChildren()
    {
        $children = $this->children;

        foreach ($this->children as $child) {
            $children = $children->merge($child->allChildren());
        }

        return $children;
    }

    /**
     * Récupère toutes les classifications parents de manière récursive.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allParents()
    {
        $parents = collect();

        $parent = $this->parent;
        while ($parent) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }
}
