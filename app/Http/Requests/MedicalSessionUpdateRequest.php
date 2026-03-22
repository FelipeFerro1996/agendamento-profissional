<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalSessionUpdateRequest extends FormRequest
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
            'session_date' => ['nullable', 'date', 'after_or_equal:today'],
            'session_time' => ['nullable', 'date_format:H:i'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'status'       => ['nullable',  Rule::in(['scheduled', 'done', 'cancelled'])],
            'paid'         => ['nullable', 'boolean'],
            'paid_at'      => ['nullable', 'date', 'required_if:paid,true'],
            'notes'        => ['nullable', 'string', 'max:5000'],
        ];
    }
}
