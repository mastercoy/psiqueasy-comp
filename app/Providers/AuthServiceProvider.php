<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $this->registerPolicies();

        //afazer vários guards. checar empresa, checar usuario, checar permissão
        //afazer guard que: verifica se pertence ao usuario logado && verifica permissões

        Gate::define('pertence-usuario-logado', function ($user, $objeto) {
            return $user->id == $objeto->user_id;
        });

        Gate::define('pertence-a-empresa', function ($user, $objeto) {
            return $user->empresa_id == $objeto->id;
        });

        Gate::define('pertence-usuario-logado-e-active', function ($user, $objeto) {
            return $user->id == $objeto->user_id && $objeto->active == 1;
        });

        Gate::define('pertence-mesma-empresa', function ($user, $objeto) { //afazer apagar
            return $user->empresa_id == $objeto->empresa_id;
        });

        Gate::define('pertence-mesma-empresa-e-tem-permissao', function ($user, $objeto) {

            $decoder         = json_decode($objeto);
            $nomePermissao   = $decoder[0];
            $usuario         = $decoder[1];
            $arrayPermissoes = $decoder[2];

            return ($user->empresa_id == $usuario->empresa_id) && (in_array($nomePermissao, $arrayPermissoes));

        });

        Gate::define('pertence-a-empresa-e-tem-permissao', function ($user, $objeto) {

            $decoder         = json_decode($objeto);
            $nomePermissao   = $decoder[0];
            $arrayPermissoes = $decoder[1];
            $empresa         = $decoder[2];
//            dd($empresa);
//            dd($empresa->id);

            return ($user->empresa_id == $empresa->id) && (in_array($nomePermissao, $arrayPermissoes));

        });


    }
}
