<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="validaLogin.php" method="post">
        <div>
            <label>E-mail</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>
</body>
</html>