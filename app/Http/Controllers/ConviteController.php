<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationInvite;
use App\Models\Convite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ConviteController extends Controller {
    //
    public function enviarEmail(Request $request) {
        Auth::loginUsingId(2); // fixme
        // gera uma string random para ser usada como token
        do {
            $token = str_random();
            // verifica se o token ja existe e se existe, gera um novo
        } while (Convite::where('token', $token)->first());

        // cria um novo convite
        $convite = Convite::create([
                                       'email' => $request->get('email'),
                                       'name' => $request->get('name'),
                                       'perfil_id' => $request->get('perfil_id'),
                                       'empresa_id' => auth()->user()->empresa_id,
                                       'token' => $token,
                                   ]);

        // envia o email
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($convite));

        // redireciona para a pagina anterior
        return redirect()->back();
    }

    public function reenviarEmail(Request $request) {
        $convite = Convite::where('email', $request->get('email'))->first();
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($convite));

    }

    public function aceitar($token) {
        $convite = Convite::where('token', $token)->first();

        // here we'll look up the user by the token sent provided in the URL
        // Look up the convite
        if (!$convite) {
            //if the convite doesn't exist do something more graceful than this
            abort(404);
        }

        $senhaTemp = str_random(6);

        // create the user with the details from the convite

        $usuario = User::create([
                                    'email' => $convite->email,
                                    'name' => $convite->name,
                                    'password' => $senhaTemp,
                                    'empresa_id' => $convite->empresa_id,
                                ]);
        $usuario->perfil()->attach($convite->perfil_id);

        // delete the convite so it can't be used again
        $convite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        echo 'Seja Bem Vindo! Sua senha provisória é: ' . $senhaTemp . '';
        echo '<br>';
        echo 'Por favor, mude-a assim que possível';

        // $resposta = ['usuario'=> $usuario, 'senha' => $senhaTemp];

        // return $resposta;
    }


}
