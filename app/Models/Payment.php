<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use BelongsToUser;

    protected $table = 'payments';
    protected $fillable = [
        'patient_id',
        'reference_month',
        'total_amount',
        'paid_amount',
        'due_date',
        'status',
    ];

    protected $visible = ['reference_month', 'total_amount'];

}
