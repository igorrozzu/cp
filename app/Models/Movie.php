<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showingMovies()
    {
        return $this->hasMany(MovieShowing::class, 'movieId');
    }
}
