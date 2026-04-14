<?php 

namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;

class PatientRepository implements PatientInterface
{

    public function index(){
        return Patient::paginate(10);
    }

    public function store(array $dados): Patient
    {
        $patient = Patient::create($dados);
        return $patient;
    }


    public function update(Patient $patient, array $dados): Patient
    {
        $patient->update($dados);
        return $patient;
    }

    public function destroy(Patient $patient): bool
    {
        return $patient->delete();
    
    }

}