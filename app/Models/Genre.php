<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * Get the shorts associated with this genre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Short>
     */
    public function shorts()
    {
        return $this->hasMany(Short::class);
    }
}
