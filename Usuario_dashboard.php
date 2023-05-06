<?php 
    session_start();

    if(empty($_SESSION)){
        echo "<script>location.href='Login.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Seja bem vindo <?php echo $_SESSION['nome'] ." ". $_SESSION['sobrenome']; ?>!</h1>
    <a href="logout.php">Sair</a>
</body>
</html>