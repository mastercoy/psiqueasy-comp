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

    public function enviarConvite(Request $request) {
        Auth::loginUsingId(1); //fixme

        $paraEncriptar = [
            'email' => $request->email,
            'perfil_id' => $request->perfil_id,
            'empresa_id' => auth()->user()->empresa_id,
        ];

        $encriptado = encrypt($paraEncriptar);

        // para saber se existe usuario cadastrado COM empresa_id
        $userComEmpresa = User::where('email', $request->get('email'))
                              ->where('empresa_id', !null)->first();

        // para saber se existe usuario cadastrado SEM empresa_id
        $userSemEmpresa = User::where('email', $request->get('email'))
                              ->where('empresa_id', null)->first();

        // se ja existir usuário cadastrado com empresa_id, não pode mandar convite
        if ($userComEmpresa) {
            return 'Usuário ja existe e tem uma empresa'; //fixme
        }

        // se ja existir usuário cadastrado sem empresa_id, tem que mandar convite diferenciado
        if ($userSemEmpresa) {
            // cria uma URL temporária
            $url = URL::SignedRoute('associar', [
                'email' => $request->email,
                'name_user' => auth()->user()->name,
                'hash' => $encriptado,
            ]);

            // caso for novo usuário
        } else {
            // cria uma URL temporária
            $url = URL::SignedRoute('completar', [
                'hash' => $encriptado,
            ]);

        }

        // envia o email contendo a URL temporária
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($url));

    }

    public function completarCadastro(Request $request) {
        // ao clicar no link do email essa view é exibida ao usuário
        // verifica se a signed URL é válida
        if (!$request->hasValidSignature()) {
            abort(response()->json('URL não válida - completarCadastro', 403));
        }

        // aqui o user completa formulário e clica em confirmar
        return View::make('cadastro')->with('request', $request->all());

    }

    public function associarCadastro(Request $request) {
        // ao clicar no link do email essa view é exibida ao usuário
        // verifica se a signed URL é válida
        if (!$request->hasValidSignature()) {
            abort(response()->json('URL não válida - associarCadastro', 403));
        }
        // tem que associar o perfil existente a empresa_id de quem convidou e ao perfil selecionado
        return View::make('associar')->with('request', $request->all());
    }

    public function aceitar(Request $request) {
        // validação acontece ao se submeter o formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|confirmed'
        ]);

        $desencriptado = decrypt($request->hash);

        // se validação falhar, exibe erros na tela
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            // passando na validação, usuário é criado com perfil e permissões ja relacionadas
            $usuario = User::create([
                                        'email' => $desencriptado['email'],
                                        'name' => $request->name,
                                        'password' => bcrypt($request->password),
                                        'empresa_id' => $desencriptado['empresa_id'],
                                    ]);
            $usuario->perfil()->attach($desencriptado['perfil_id']);

            return 'Usuário criado com sucesso';
        }


    }


}

