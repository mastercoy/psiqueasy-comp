<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Confirmação de Cadastro</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>

    <body>
        <h1>Por favor, confirme seu Cadastro!</h1>
        <div id="app">

            <hr>
            <form action="{{route("aceitar")}}" method="post">
                <input type="hidden" name="email" value="{{$request['email']}}">
                <input type="hidden" name="perfil_id" value="{{$request['perfil_id']}}">
                <input type="hidden" name="empresa_id" value="{{$request['empresa_id']}}">
                <input type="hidden" name="signature" value="{{$request['signature']}}">
                <br>
                <label for="name">Digite seu nome: </label>
                <input type="text" id="Nome" name="name" placeholder="Nome">
                <br>
                <label for="password">Digite sua senha: </label>
                <input type="password" name="password" id="password">
                <br>
                <label for="password_confirmation">confirme sua senha: </label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <hr>
                <button type="submit" id="convite">Enviar</button>
            </form>
        </div>

    </body>

</html>
