<?php

namespace App\Http\Controllers;


class HomeController extends Controller {

    /**
     * HomeController constructor.
     */
    public function __construct() {
        $this->middleware('auth'); //obs aqui, middleware da rota?
    }


    public function index() {
        return view('home');
    }
}
