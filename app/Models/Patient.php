<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Patient extends Model
{
    use BelongsToUser;
    use HasFactory;
    
    protected $table = 'patients';
    protected $fillable = ['name', 'phone', 'email', 'birth_date', 'notes', 'cpf'];
    protected $guarded = ['cpf_encrypted', 'cpf_hash', 'updated_at', 'created_at'];
    protected $visible = ['name', 'phone', 'email', 'birth_date', 'notes', 'cpf'];
    protected $appends = ['cpf'];

    // setter CPF
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf_encrypted'] = Crypt::encryptString($value);
        $this->attributes['cpf_hash'] = hash('sha256', $value);
    }

    // getter CPF
    public function getCpfAttribute()
    {
        return Crypt::decryptString($this->cpf_encrypted);
    }
    
}
