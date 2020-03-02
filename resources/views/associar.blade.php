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
        <h1>Olá {{\App\User::where('email', $request['email'])->first()->name}}!</h1>
        <div id="app">
            <p>Você foi convidado para utilizar o sistema PsiquEasy através de {{$request['name_user']}}! </p>
            <p>Gostaria de confirmar sua associação? </p>
            <form action="{{route("associar_user")}}" method="post">
                <input type="hidden" name="hash" value="{{$request['hash']}}">

                <button type="submit">Confirmar</button>
            </form>
        </div>

    </body>

</html>
