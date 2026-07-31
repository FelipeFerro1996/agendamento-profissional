<?php 

namespace App\Rules;

use App\Models\Patient;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfRule implements ValidationRule
{

    public function __construct(
        public ?Patient $patient = NULL 
    )
    {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('CPF inválido.');
            return;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                $fail('CPF inválido.');
                return;
            }
        }

        // Verifica duplicidade
        $query = Patient::where('cpf_hash', hash('sha256', $cpf));

        if (!empty($this->patient->id)) {
            $query->where('id', '<>', $this->patient->id);
        }

        if ($query->exists()) {
            $fail('Este CPF já está cadastrado.');
        }

    }
}