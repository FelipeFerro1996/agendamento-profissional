<?php 

namespace App\Repositories;

use App\Interfaces\MedicalSessionInterface;
use App\Models\MedicalSession;
use Throwable;

class MedicalSessionRepository implements MedicalSessionInterface
{

    public function index(array $busca, bool $nao_paginar = false){

        $medical_sessions = new MedicalSession();

        if($nao_paginar){
            return $medical_sessions->get();
        }

        return $medical_sessions->paginate(10);
    }

    public function store(array $dados): array
    {
        try{

            $medical_session = MedicalSession::create($dados);
            
            return [
                'success' => true,
                'message' => 'Cadastrado com sucesso',
                'dados' => $medical_session
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao cadastrar o Sessão',
                'error' => $e->getMessage()
            ];
        }
    }


    public function update(MedicalSession $medical_session, array $dados): array
    {
        try{

            $medical_session->update($dados);
            
            return [
                'success' => true,
                'message' => 'Atualizado com sucesso',
                'dados' => $medical_session
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao alterar o Sessão',
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy(MedicalSession $medical_session): array
    {
        try{

            $medical_session->delete();
            
            return [
                'success' => true,
                'message' => 'Excluído com sucesso'
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao excluir o Sessão',
                'error' => $e->getMessage()
            ];
        }
    }

}