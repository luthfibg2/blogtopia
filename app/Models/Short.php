<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Short extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the author of the blog.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the blog.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Genre>
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeFilterShort(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('title', 'like', "%{$search}%")
        );

        $query->when(
            $filters['genre'] ?? false,
            fn ($query, $genre) =>
            $query->whereHas('genre', fn($query) => $query->where('slug', $genre))
        );
    }
}
