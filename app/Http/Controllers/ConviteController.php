<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationInvite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class ConviteController extends Controller {
    //
    public function enviarConvite(Request $request) {
        Auth::loginUsingId(1);

        // para saber se existe usuario cadastrado COM empresa_id
        $userComEmpresa = User::where('email', $request->get('email'))
                              ->where('empresa_id', auth()->user()->empresa_id)->first();

        // para saber se existe usuario cadastrado SEM empresa_id
        $userSemEmpresa = User::where('email', $request->get('email'))
                              ->where('empresa_id', null)->first();

        // se ja existir não pode mandar convite
        if ($userComEmpresa) {
            return 'Usuário ja existe e tem uma empresa'; //fixme
        }

        // se ja existir tem que mandar convite diferenciado
        if ($userSemEmpresa) {
            // cria uma URL temporária
            $url = URL::temporarySignedRoute('associar', now()->addHours(5), [
                'email' => $request->get('email'),
                'perfil_id' => $request->get('perfil_id'),
                'empresa_id' => auth()->user()->empresa_id,
                'name_user' => auth()->user()->name,
            ]);

        } else {
            // cria uma URL temporária
            $url = URL::temporarySignedRoute('completar', now()->addHours(5), [
                'email' => $request->get('email'),
                'perfil_id' => $request->get('perfil_id'),
                'empresa_id' => auth()->user()->empresa_id,
            ]);

        }

        // envia o email contendo a URL temporária
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($url));

    }

    public function completarCadastro(Request $request) {
        // ao clicar no link do email essa view é exibida ao usuário
        // aqui o user completa formulário e clica em confirmar
        return View::make('cadastro')->with('request', $request->all());

    }

    public function associarCadastro(Request $request) {
        // tem que associar o perfil existente a empresa_id de quem convidou e ao perfil selecionado
        return View::make('associar')->with('request', $request->all());
    }

    public function aceitar(Request $request) {
        // verifica se a signed URL é válida
        if (!$request->hasValidSignature()) {
            abort(response()->json('URL não válida - aceitar', 403));
        }

        // ao submeter o formulario anterior, faz validação
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'perfil_id' => 'required',
            'empresa_id' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        // se validação falhar exibe erros na tela
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // se passar na validação usuário é criado com perfil e permissões ja relacionadas
            $usuario = User::create([
                                        'email' => $request->email,
                                        'name' => $request->name,
                                        'password' => bcrypt($request->password),
                                        'empresa_id' => $request->empresa_id,
                                    ]);
            $usuario->perfil()->attach($request->perfil_id);

            return 'Usuário criado com sucesso';
        }


    }


}

