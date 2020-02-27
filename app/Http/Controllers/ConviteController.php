<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationInvite;
use App\Models\Convite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class ConviteController extends Controller {
    //

    public function enviarEmail(Request $request) {
        Auth::loginUsingId(1); // fixme

        // para ter ctz que não mandará segundo convite diferente para mesma pessoa da mesma empresa
        // $convite = Convite::where('email', $request->get('email'))
        //                   ->where('empresa_id', auth()->user()->empresa_id)
        //                   ->first();
        //
        // // se ja existe convite para esse email por essa empresa, reenvia o convite
        // if ($convite) {
        //     // abort(304);
        //     $this->reenviarEmail($request);
        //     // return redirect()->back();
        // }

        // gera uma string random para ser usada como token
        // do {
        //     $token = str_random(32);
        //     // verifica se o token ja existe e se existe, gera um novo
        // } while (Convite::where('token', $token)->first());

        $url = URL::temporarySignedRoute('aceitar', now()->addHour(24), [
            'email' => $request->get('email'),
            'perfil_id' => $request->get('perfil_id'),
            'empresa_id' => auth()->user()->empresa_id,
        ]);

        // dd($url);

        // cria um novo convite
        /*$convite = Convite::create([
                                       'email' => $request->get('email'),
                                       'expire_date' => Carbon::now()->addDays(7),
                                       'perfil_id' => $request->get('perfil_id'),
                                       'empresa_id' => auth()->user()->empresa_id,
                                       'token' => $token,
                                   ]);*/

        // envia o email
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($url));

        // redireciona para a pagina anterior
        // return redirect()->back();
    }

    // public function reenviarEmail(Request $request) {
    //     $convite = Convite::where('email', $request->get('email'))->first();
    //     Mail::to($request->get('email'))->send(new UserRegistrationInvite($convite));
    // }

    public function aceitar(Request $request) { //afazer se convite expirar
        /* if ($request->hasValidSignature()) {
             dd('tem válido');
         } else {
             dd('nao ta valido');
         }*/
        dd($request->all());
        // fixme não precisa de senha temporária, tirar criação de user aqui

        // acha o convite através do token
        $convite = Convite::where('token', $token)->first();

        // se convite na existe
        if (!$convite) {
            abort(404);
        }

        $senhaTemp = str_random(6); // cria uma string como senha temporária

        // cria o usuário utilizando os detalhes do convite
        $usuario = User::create([
                                    'email' => $convite->email,
                                    'name' => $convite->name,
                                    'password' => $senhaTemp,
                                    'empresa_id' => $convite->empresa_id,
                                ]);
        $usuario->perfil()->attach($convite->perfil_id);

        // após usado, deleta o convide do banco de dados
        $convite->delete();

        // aqui deve exibir uma pagina bonitinha para o usuário

        // mensagem provisoria com a senha temporária
        echo 'Seja Bem Vindo! Sua senha provisória é: ' . $senhaTemp . '';
        echo '<br>';
        echo 'Por favor, mude-a assim que possível';

    }


}
