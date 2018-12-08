<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MovieShowing
 * @package App\Models
 * @property int $id
 * @property int $movieId
 * @property int $cinemaId
 * @property string $showingFrom
 * @property string $showingTo
 */
class MovieShowing extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cinema()
    {
        return $this->hasOne(Cinema::class, 'id', 'cinemaId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movie()
    {
        return $this->hasOne(Movie::class, 'id', 'movieId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seances()
    {
        return $this->hasMany(Seance::class, 'movieShowingId');
    }
}
