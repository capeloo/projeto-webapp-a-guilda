<?php 
    include('config.php');

    switch($_REQUEST["acao"]){
        case 'cadastrar':
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES ('{$nome}', '{$sobrenome}', '{$email}', '{$senha}')";

            $res = $connection->query($sql);

            if($res == true){
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>location.href='Login.php';</script>";
            } else {
                echo "<script>alert('Não foi possível cadastrar!');</script>";
                echo "<script>location.href='Pagina_inicial';</script>";
            } 
            break;
    }
?>