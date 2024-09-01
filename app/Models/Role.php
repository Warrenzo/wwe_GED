<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relation many-to-many avec les permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Relation many-to-many avec les utilisateurs.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
