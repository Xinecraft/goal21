<?php

namespace App;

use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, WalletFloat, Wallet
{
    use Notifiable, SoftDeletes, HasWalletFloat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'uuid', 'username', 'gender', 'dob', 'last_login_ip', 'phone_number', 'referral_user_id', 'payment_amount', 'payment_confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'kyc_request_at', 'kyc_approved_at'];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['user' => ['id' => $this->id]];
    }

    /**
     * This person who referred
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referredby()
    {
        return $this->belongsTo('App\User', 'referral_user_id');
    }

    /**
     * All users whom he referred
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany('App\User', 'referral_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '>', 0);
    }

    /**
     * @return string
     */
    public function getBankAccountTypeHrAttribute()
    {
        switch ($this->bank_account_type) {
            case 'SA':
                return "Saving Account";
                break;
            case 'CA':
                return "Current Account";
                break;
            case 'RDA':
                return "Recurring Deposit Account";
                break;
            case 'FDA':
                return "Fixed Deposit Account";
                break;
            case 'DTA':
                return "DEMAT Account";
                break;
            case 'NRA':
                return "NRI Accounts";
                break;
            default:
                return "Saving Account";
        }
    }

    /**
     * @return null|string
     */
    public function getPaytextdataAttribute()
    {
        switch ($this->preferred_payment_method) {
            case 'PAYTM':
                $data = "PayTM Number: " . $this->paytm_number;
                if ($this->upi_id != null)
                    $data = $data . "\n\nUPI ID: " . $this->upi_id;
                if ($this->bank_account_number != null)
                    $data = $data . "\n\nHolder Name: {$this->bank_account_holdername}\nAccount Number: {$this->bank_account_number}\nBank Name: {$this->bank_account_bankname}\nAccount Type: {$this->bank_account_type_hr}\nIFSC Code: {$this->bank_account_ifsc}";
                return $data;
                break;
            case 'UPI':
                $data = "UPI ID: " . $this->upi_id;
                if ($this->paytm_number != null)
                    $data = $data . "\n\nPayTM Number: " . $this->paytm_number;
                if ($this->bank_account_number != null)
                    $data = $data . "\n\nHolder Name: {$this->bank_account_holdername}\nAccount Number: {$this->bank_account_number}\nBank Name: {$this->bank_account_bankname}\nAccount Type: {$this->bank_account_type_hr}\nIFSC Code: {$this->bank_account_ifsc}";
                return $data;
                break;
            case 'BANK':
                $data = "Holder Name: {$this->bank_account_holdername}\nAccount Number: {$this->bank_account_number}\nBank Name: {$this->bank_account_bankname}\nAccount Type: {$this->bank_account_type_hr}\nIFSC Code: {$this->bank_account_ifsc}";
                if ($this->paytm_number != null)
                    $data = $data . "\n\nPayTM Number: " . $this->paytm_number;
                if ($this->upi_id != null)
                    $data = $data . "\n\nUPI ID: " . $this->upi_id;
                return $data;
                break;
            default:
                return null;
        }
    }

    public function getProfilePhotoAttribute()
    {
        if ($this->photo)
            return asset('storage/' . $this->photo);
        if ($this->gender == "M")
            return asset('images/defaultprofile/g932.png');
        if ($this->gender == "F")
            return asset('images/defaultprofile/g1092.png');
        if ($this->gender == "O")
            return asset('images/defaultprofile/g732.png');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->user_role > 50)
            return true;
        return false;
    }
}
