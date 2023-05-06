<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Criar conta</h1>
    <form action="crud.php" method="post">
        <input type="hidden" name="acao" value="cadastrar">
        <div>
            <label>Nome</label>
            <input type="text" name="nome">
        </div>
        <div>
            <label>Sobrenome</label>
            <input type="text" name="sobrenome">
        </div>
        <div>
            <label>E-mail</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha">
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</body>
</html>