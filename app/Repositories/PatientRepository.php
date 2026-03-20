<?php 

namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;
use Throwable;

class PatientRepository implements PatientInterface
{

    public function index(){
        return Patient::paginate(10);
    }

    public function store(array $dados): array
    {
        try{

            $patient = Patient::create($dados);
            
            return [
                'success' => true,
                'message' => 'Cadastrado com sucesso',
                'dados' => $patient
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao cadastrar o Paciente',
                'error' => $e->getMessage()
            ];
        }
    }

}