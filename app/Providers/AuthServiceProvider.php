<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        $this->registerPolicies();

        //afazer os GATES
        // definição, closing


        /*------------------------------------------------------------------------
        | VERIFICAR SE O OBJETO PASSADO PERTENCE A USUÁRIO LOGADO
        |------------------------------------------------------------------------*/

        Gate::define('pertence-usuario-logado', function ($user, $objeto) {
            return $user->id == $objeto->user_id;
        });

        /*------------------------------------------------------------------------
        | VERIFICAR SE O PACIENTE PASSADO PERTENCE A USUÁRIO LOGADO E ESTÁ ATIVO
        |------------------------------------------------------------------------*/

        Gate::define('pertence-usuario-logado-e-active', function ($user, $objeto) {
            return $user->id == $objeto->user_id && $objeto->active == 1;
        });

    }
}
