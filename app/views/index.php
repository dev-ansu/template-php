<h1>Página principal</h1>

<form method="POST" action="<?= BASE_URL ?>/login">
    <input type="text" name="_csrf_token" value="<?= $token ?>">
    <button>Teste</button>
</form>