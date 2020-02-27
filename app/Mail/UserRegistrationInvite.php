<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationInvite extends Mailable {
    use Queueable, SerializesModels;

    public $url;

    public function __construct($url) {
        //
        $this->url = $url;
    }

    public function build() {
        return $this->view('emails.email')
                    ->subject('Você foi convidado para o PsiquEasy por ' . auth()->user()->name)
                    ->from('psiqueasy@oliveiracorp.com.br', 'PsiquEasy')
                    ->replyTo('psiqueasy@oliveiracorp.com.br', 'PsiquEasy');

    }
}
