<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    public static $LEVEL_1 = 1;
    public static $LEVEL_2 = 2;
    public static $LEVEL_3 = 3;
    public static $LEVEL_4 = 4;

    /**
     * Medication relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medications()
    {
        return $this->belongsToMany(Medication::class);
    }
}
