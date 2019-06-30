<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const MAX_ALLOWABLE_TASK = 40;

    protected $fillable = ['type', 'uuid', 'link', 'credit_inr', 'wait_in_seconds', 'description', 'is_active', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('App\User')->withPivot('status')->withTimestamps();
    }
}
