<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class MedicalSession extends Model
{
    use BelongsToUser;

    protected $table = 'medical_sessions';
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
