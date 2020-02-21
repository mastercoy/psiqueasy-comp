<?php

namespace App\Mail;

use App\Models\Convite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class UserRegistrationInvite extends Mailable {
    use Queueable, SerializesModels;

    public $convite;

    public function __construct(Convite $convite) {
        //
        $this->convite = $convite;
    }


    public function build() { // obs
        Auth::loginUsingId(1);
        return $this->view('emails.email')
                    ->subject('Você foi convidado para o PsiquEasy por ' . auth()->user()->name)
                    ->from('psiqueasy@oliveiracorp.com.br', 'PsiquEasy')
                    ->replyTo('psiqueasy@oliveiracorp.com.br', 'PsiquEasy');

    }
}
