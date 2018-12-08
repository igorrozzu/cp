<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seance
 * @package App\Models
 * @property int $id
 * @property int $cost
 * @property int $movieShowingId
 * @property int $showingDate
 */
class Seance extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'seanceId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function showingMovie()
    {
        return $this->hasOne(MovieShowing::class);
    }
}
