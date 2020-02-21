<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UserRegistrationInvite extends Mailable {
    use Queueable, SerializesModels;


    public function __construct() {
        //
    }


    public function build() { // obs Obrigatórios campos no json 'email' 'name'
        Auth::loginUsingId(1);
        return $this->view('emails.email')
                    ->subject('Você foi convidado para o PsiquEasy por ' . auth()->user()->name)
                    ->from('psiqueasy@oliveiracorp.com.br', 'PsiquEasy')
                    ->replyTo('psiqueasy@oliveiracorp.com.br', 'PsiquEasy');

    }
}
