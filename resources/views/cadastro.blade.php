<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Página de Teste para Nylo</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


</head>

<body>
    <h1>Página de Teste</h1>
    <div id="app">
        <div class="form">
            <hr>
            <label for="Nome">Digite o nome: </label>
            <input type="text" id="Nome" placeholder="Ex: Nylo ">
            <br>
            <label for="email">Digite o email: </label>
            <input disabled type="text" id="email" placeholder="Ex: nylus@gamil.com">
            <br>
            <label for="senha">Digite a senha: </label>
            <input type="password" id="senha">
            <br>
            <label for="senhaA">confirme a senha: </label>
            <input type="password" id="senhaA">
        </div>
    </div>

    </div>


    <script></script>
</body>

</html>