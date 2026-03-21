<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use BelongsToUser;

    protected $table = 'sessions';
    protected $fillable = [
        'patient_id',
        'session_date',
        'session_time',
        'price',
        'status',
        'paid',
        'paid_at',
        'notes'
    ];
}
