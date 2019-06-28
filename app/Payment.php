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
    protected $fillable = ['uuid', 'user_id', 'payment_method', 'payment_data', 'payment_amount', 'payment_txn_id', 'paid_at'];

    // Who is owner of this payput
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 0);
    }
    public function scopePaid($query)
    {
        return $query->where('payment_status', 1);
    }
}
