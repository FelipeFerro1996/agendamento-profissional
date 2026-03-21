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


    public function update(Patient $patient, array $dados): array
    {
        try{

            $patient->update($dados);
            
            return [
                'success' => true,
                'message' => 'Atualizado com sucesso',
                'dados' => $patient
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao alterar o Paciente',
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy(Patient $patient): array
    {
        try{

            $patient->delete();
            
            return [
                'success' => true,
                'message' => 'Excluído com sucesso'
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao excluir o Paciente',
                'error' => $e->getMessage()
            ];
        }
    }

}