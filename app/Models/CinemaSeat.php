<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CinemaSeat
 * @package App\Models
 * @property int $id
 * @property int $cinemaId
 * @property int $rawNumber
 * @property int $seatNumber
 * @property int $status
 */
class CinemaSeat extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cinema()
    {
        return $this->hasOne(Cinema::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booking()
    {
        return $this->hasOne(Booking::class, 'seatId', 'id');
    }
}
