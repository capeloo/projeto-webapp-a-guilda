<?php 
    session_start();

    if(empty($_POST) or (empty($_POST["email"]) or (empty($_POST["senha"])))){
        echo "<script>location.href='Login.php';</script>";
    }

    include('config.php');

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios
            WHERE email = '{$email}'
            AND senha = '{$senha}'";

    $res = $connection->query($sql) or die($connection->error);

    $row = $res->fetch_object();
    
    $qtd = $res->num_rows;

    if($qtd > 0){
        $_SESSION["nome"] = $row->nome;
        $_SESSION["sobrenome"] = $row->sobrenome;
        
        echo "<script>location.href='Usuario_dashboard.php';</script>";
    } else {
        echo "<script>alert('Usuário ou senha incorreto(s)');</script>";
        echo "<script>location.href='Login.php';</script>";
    }
?>