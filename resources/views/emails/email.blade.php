<!DOCTYPE html>
<html>

    <body>
        <?php use Illuminate\Support\Facades\Input;$user = auth()->user();$input = Input::all();?>

        <h1>Esse é um email de testes</h1>
        <p>Obrigado, {{  $input['name'] }}</p>

    </body>

</html>
