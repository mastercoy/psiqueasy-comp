<p>Olá, {{$convite->name}}</p>

<p>Você foi convidado para usar o sistema PsiquEasy por {{auth()->user()->name}}</p>

<a href="{{ route('aceitar', $convite->token) }}">Clique aqui</a> para ativar!
