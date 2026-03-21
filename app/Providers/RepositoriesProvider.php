<?php

namespace App\Providers;

use App\Interfaces\PatientInterface;
use App\Repositories\PatientRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        PatientInterface::class => PatientRepository::class
    ];
    
}
