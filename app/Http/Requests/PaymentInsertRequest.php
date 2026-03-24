<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentInsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:patients,id'],
            'reference_month' => ['required', 'string', 'max:20'], // Ex: "Janeiro/2026"
            'total_amount' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'paid_amount' => ['nullable', 'numeric', 'min:0', 'decimal:0,2'],
            'due_date' => ['nullable', 'date'],
            'status' => [
                'nullable', 
                Rule::in(['open', 'partial', 'paid'])
            ],
        ];
    }
}
