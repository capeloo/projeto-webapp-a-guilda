<?php 
    // Inicialize a sessão
    session_start();

    // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/media-queries.css">
</head>
<body>
    <h1 class="my-5">Oi, <b><?php echo htmlspecialchars($_SESSION["login"]); ?></b>. Bem vindo ao nosso site.</h1>
    <p>
        <a href="reset-senha.php" class="btn btn-warning">Redefina sua senha</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p>
</body>
</html>