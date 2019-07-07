<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const MAX_ALLOWABLE_TASK = 40;
    const TYPE_APP_DOWNLOAD = 0;
    const TYPE_VIDEO = 2;
    const TYPE_WEBSITE = 1;

    protected $fillable = ['type', 'uuid', 'link', 'credit_inr', 'wait_in_seconds', 'description', 'is_active', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('status')->withTimestamps();
    }

    public function getTypeNameAttribute()
    {
        switch ($this->type)
        {
            case self::TYPE_APP_DOWNLOAD:
                return 'App Download';
                break;
            case self::TYPE_WEBSITE:
                return 'Website Visit';
                break;
            case self::TYPE_VIDEO:
                return 'Watch Video';
                break;
            default:
                return 'None';
        }
    }
}
