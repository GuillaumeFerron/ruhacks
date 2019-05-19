<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['*'];

    /**
     * Medication relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }
}
