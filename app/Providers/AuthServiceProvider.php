<?php

namespace App\Providers;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot() {
        $this->registerPolicies();

        Gate::define('tem-permissao', function ($user, $objeto) {
            $permissoesUser = (new UserController)->retornaPermissoes();
            return in_array($objeto, $permissoesUser);
        });

        Gate::define('pertence-usuario-logado-e-tem-permissao', function ($user, $objeto) {

            // $permissoesUser = (new UserController)->retornaPermissoes();
            $permissoesUser = (new UserController)->retornaPermissoes();
            $decoder        = json_decode($objeto);
            $nomeMetodo     = $decoder[0];
            $item           = $decoder[1];

            return ($user->id == $item->user_id) && (in_array($nomeMetodo, $permissoesUser));
        });

        Gate::define('pertence-mesma-empresa-e-tem-permissao', function ($user, $objeto) {

            $permissoesUser = (new UserController)->retornaPermissoes();
            $decoder        = json_decode($objeto);
            $nomeMetodo     = $decoder[0];
            $item           = $decoder[1];

            return ($user->empresa_id == $item->empresa_id) && (in_array($nomeMetodo, $permissoesUser));

        });

        Gate::define('pertence-a-empresa-e-tem-permissao', function ($user, $objeto) {

            $permissoesUser = (new UserController)->retornaPermissoes();
            $decoder        = json_decode($objeto);
            $nomeMetodo     = $decoder[0];
            $empresa        = $decoder[1];

            return ($user->empresa_id == $empresa->id) && (in_array($nomeMetodo, $permissoesUser));

        });

        // ========================================================================
        // ========================================================================
        // ========================================================================


        Gate::define('pertence-usuario-logado', function ($user, $objeto) {
            return $user->id == $objeto->user_id;
        });

        Gate::define('pertence-a-empresa', function ($user, $objeto) {
            return $user->empresa_id == $objeto->id;
        });

        Gate::define('pertence-usuario-logado-e-active', function ($user, $objeto) {
            return $user->id == $objeto->user_id && $objeto->active == 1;
        });

        Gate::define('pertence-mesma-empresa', function ($user, $objeto) {
            return $user->empresa_id == $objeto->empresa_id;
        });


    }
}
