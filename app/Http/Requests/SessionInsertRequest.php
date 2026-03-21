<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SessionInsertRequest extends FormRequest
{
    /**
     * Regras de validação aplicadas à requisição.
     */
    public function rules(): array
    {
        return [
            'patient_id'   => ['required', 'exists:patients,id'],
            'session_date' => ['required', 'date', 'after_or_equal:today'],
            'session_time' => ['required', 'date_format:H:i'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'status'       => ['nullable', Rule::in(['scheduled', 'done', 'cancelled'])],
            'paid'         => ['nullable', 'boolean'],
            'paid_at'      => ['nullable', 'date', 'required_if:paid,true'],
            'notes'        => ['nullable', 'string', 'max:5000'],
        ];
    }

    /**
     * Customização dos nomes dos atributos para mensagens de erro.
     */
    public function attributes(): array
    {
        return [
            'patient_id'   => 'paciente',
            'session_date' => 'data da sessão',
            'session_time' => 'horário da sessão',
            'price'        => 'valor',
            'status'       => 'status',
            'paid'         => 'pago',
            'paid_at'      => 'data do pagamento',
            'notes'        => 'observações',
        ];
    }
}
