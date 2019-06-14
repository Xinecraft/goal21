<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'paid_at', 'verified_at'];

    /**
     * @var array
     */
    protected $fillable = ['uuid', 'sender_id', 'receiver_id', 'payment_method', 'payment_data', 'payment_amount'];

    // Who sent this payment
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }

    // Who sent this payment
    public function receiver()
    {
        return $this->belongsTo('App\User','receiver_id');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 0);
    }
    public function scopeVerified($query)
    {
        return $query->where('payment_status', 1);
    }

    public function scopePaidorverified($query)
    {
        return $query->where('payment_status', '>=', 0);
    }
}
