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
    public function convidar() {
        // show the user a form with an email field to invite a new user
    }

    public function processar(Request $request) {
        Auth::loginUsingId(1); //fixme
        // validate the incoming request data
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Convite::where('token', $token)->first());

        //create a new convite record
        $convite = Convite::create([
                                       'email' => $request->get('email'),
                                       'name' => $request->get('name'),
                                       'perfil_id' => $request->get('perfil_id'),
                                       'empresa_id' => auth()->user()->empresa_id,
                                       'token' => $token,
                                   ]);


        // send the email
        Mail::to($request->get('email'))->send(new UserRegistrationInvite($convite));

        // redirect back where we came from
        // return redirect()
        // ->back();
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
        echo '<br>';
        echo 'Por favor, mude-a assim que possível';
    }

    /*public function processar() {
        // process the form submission and send the invite by email
        Auth::loginUsingId(1); //fixme
        $input = Input::get('email');
        Mail::to($input)->send(new UserRegistrationInvite());
    }*/
}
