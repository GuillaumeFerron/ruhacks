<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reminders relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Warnings relationships
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function warning()
    {
        return $this->hasMany(Warning::class);
    }

    /**
     * Pictures relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
