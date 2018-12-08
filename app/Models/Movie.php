<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 * @package App\Models
 * @property int $id
 * @property string $description
 * @property int $duration
 * @property int $rating
 * @property string $name
 * @property string $slogan
 */
class Movie extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showingMovies()
    {
        return $this->hasMany(MovieShowing::class, 'movieId');
    }
}
