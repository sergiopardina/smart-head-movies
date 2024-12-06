<?php

namespace App\Traits;

trait Filterable
{
    public function scopeByGenreIds($query, $genreIds)
    {
        if (empty($genreIds)) {
            return $query;
        }

        return $query->whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genres.id', $genreIds);
        });
    }

    public function scopeByIds($query, $ids)
    {
        if (empty($ids)) {
            return $query;
        }

        return $query->whereIn('id', $ids);
    }
}
