<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 * @package App\Models
 * @property int $id
 * @property int $seatId
 * @property int $seanceId
 * @property int $userId
 */
class Booking extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seance()
    {
        return $this->hasOne(Seance::class);
    }
}
