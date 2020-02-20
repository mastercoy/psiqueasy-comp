<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationInvite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;


class EnviarEmailController extends Controller {
    //
    public function sendEmail() {
        Auth::loginUsingId(1); //fixme
        $input = Input::get('email');
        Mail::to($input)->send(new UserRegistrationInvite());

        // if (Mail::failures()) {
        //     return response()->Fail('Sorry! Please try again latter');
        // } else {
        //     return response()->success('Great! Successfully send in your mail');
        // }
    }
}
