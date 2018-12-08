<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cinema
 * @package App\Models
 * @property int $id
 * @property string $manager
 * @property string $address
 * @property int $phone
 * @property string $name
 */
class Cinema extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats()
    {
        return $this->hasMany(CinemaSeat::class, 'cinemaId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function showingMovies()
    {
        return $this->hasManyThrough(
            Movie::class, MovieShowing::class, 'cinemaId', 'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'cinemaId');
    }
}
