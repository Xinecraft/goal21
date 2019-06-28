<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['type', 'uuid', 'link', 'credit_inr', 'wait_in_seconds', 'description', 'is_active', 'user_id'];
}
