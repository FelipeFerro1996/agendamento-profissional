<?php 

namespace App\Repositories;

use App\Interfaces\SessionInterface;
use App\Models\Session;
use Throwable;

class SessionRepository implements SessionInterface
{

    public function index(array $busca, bool $nao_paginar = false){

        $sessions = new Session();

        if($nao_paginar){
            return $sessions->get();
        }

        return $sessions->paginate(10);
    }

    public function store(array $dados): array
    {
        try{

            $session = Session::create($dados);
            
            return [
                'success' => true,
                'message' => 'Cadastrado com sucesso',
                'dados' => $session
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao cadastrar o Sessão',
                'error' => $e->getMessage()
            ];
        }
    }


    public function update(Session $session, array $dados): array
    {
        try{

            $session->update($dados);
            
            return [
                'success' => true,
                'message' => 'Atualizado com sucesso',
                'dados' => $session
            ];

        }catch(Throwable $e){

            return [
                'success' => false,
                'message' => 'Erro ao alterar o Sessão',
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy(Session $session): array
    {
        try{

            $session->delete();
            
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