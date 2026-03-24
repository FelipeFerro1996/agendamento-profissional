<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentUpdateRequest extends FormRequest
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
            'reference_month' => ['sometimes', 'string', 'max:20'],
            'total_amount'    => ['sometimes', 'numeric', 'min:0'],
            'paid_amount'     => ['sometimes', 'numeric', 'min:0'],
            'due_date'        => ['nullable', 'date'],
            'status'          => ['sometimes', Rule::in(['open', 'partial', 'paid'])],
        ];
    }
}
