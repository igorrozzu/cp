<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaSeat extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cinema()
    {
        return $this->hasOne(Cinema::class);
    }
}