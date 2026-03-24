<?php

namespace App\Providers;

use App\Interfaces\PatientInterface;
use App\Interfaces\MedicalSessionInterface;
use App\Interfaces\PaymentInterface;
use App\Repositories\MedicalSessionRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        PatientInterface::class => PatientRepository::class,
        MedicalSessionInterface::class => MedicalSessionRepository::class,
        PaymentInterface::class => PaymentRepository::class
    ];
    
}
