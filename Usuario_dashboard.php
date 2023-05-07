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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-image" 
      style="background-image: url('./Imagens/bg.jpg'); 
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;">
    <div class="container-fluid text-center mt-4 bg-light" style="width: 400px;">
        <h1 class="p-4">Seja bem vindo, <?php echo $_SESSION['apelido'] ?>!</h1>
        <div class="p-4">
            <a href="logout.php" class="btn btn-danger" style="width: 100px;">Sair</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>