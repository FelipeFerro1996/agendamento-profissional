<?php 

namespace App\Repositories;

use App\Interfaces\MedicalSessionInterface;
use App\Models\MedicalSession;

class MedicalSessionRepository implements MedicalSessionInterface
{

    public function index(array $busca, bool $nao_paginar = false){

        $medical_sessions = new MedicalSession();

        if(!empty($busca['session_date'])){
            $medical_sessions = $medical_sessions->where('session_date', $busca['session_date']);
        }

        if(!empty($busca['status_not_in'])){
            $medical_sessions = $medical_sessions->where('status', '<>', $busca['status_not_in']);
        }

        $medical_sessions = $medical_sessions->with('patient');

        if($nao_paginar){
            return $medical_sessions->get();
        }

        return $medical_sessions->paginate(10);
    }

    public function store(array $dados): MedicalSession
    {
        return MedicalSession::create($dados);
    }


    public function update(MedicalSession $medical_session, array $dados): MedicalSession
    {
        $medical_session->update($dados);
        return $medical_session;
    }

    public function destroy(MedicalSession $medical_session): bool
    {
        return $medical_session->delete();
    }

}