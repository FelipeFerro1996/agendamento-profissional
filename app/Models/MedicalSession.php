<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSession extends Model
{
    use BelongsToUser;
    use HasFactory;

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

    protected $visible = [
        'patient_id',
        'session_date',
        'session_time',
        'price',
        'status',
        'paid',
        'paid_at',
        'notes',
        'data_formatada',
        'patient'
    ];

    protected $appends = [
        'data_formatada'
    ];

    public function getDataFormatadaAttribute(){
        return Carbon::parse($this->session_date)->format('d/m/Y');
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
