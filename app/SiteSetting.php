<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['setting', 'value'];

    /**
     * Get a setting via key
     *
     * @param $setting
     * @return
     */
    public static function getSetting($setting)
    {
        if($data = static::whereSetting($setting)->first())
            return $data->value;
        return '';
    }
}
