<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @package App\Models
 * @property int $id
 * @property int $cinemaId
 * @property int $userId
 * @property int $mark
 * @property string $text
 * @property int $status
 */
class Review extends Model
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
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userSecure()
    {
        return $this->user()->select(['id', 'login']);
    }
}
