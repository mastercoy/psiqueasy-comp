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

        Gate::define('pertence-mesma-empresa', function ($user, $objeto) {
            return $user->empresa_id == $objeto->empresa_id;
        });

        Gate::define('pertence-usuario-e-tem-permissao', function ($user, $arrayPermissoes, $nomePermissao) {
            dd($arrayPermissoes);
            dd($nomePermissao);
            dd($user);

        });

        /*
         * $listaPermissoesUser = [];

        if (isset(User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'])) {
            $user = User::where('id', $user_json->id)->with('perfil.permissao')->first()->toArray()['perfil'][0]['permissao'];
            foreach ($user as $permissoes) {
                $listaPermissoesUser[] = $permissoes['name'];
            }
        }

        $usuarioAndPermissoes[] = User::find($user_json->id)->toArray();
        $usuarioAndPermissoes[] = $listaPermissoesUser;

        return $usuarioAndPermissoes;
         *
         *
         */

        //

    }
}
