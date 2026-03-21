<?php

namespace App\Providers;

use App\Interfaces\PatientInterface;
use App\Interfaces\SessionInterface;
use App\Repositories\PatientRepository;
use App\Repositories\SessionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        PatientInterface::class => PatientRepository::class,
        SessionInterface::class => SessionRepository::class
    ];
    
}
