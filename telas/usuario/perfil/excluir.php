<?php
    session_start();

    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    if($_SESSION["admin"] == 0){
        $sql = "DELETE FROM usuario 
            WHERE id=" . $_SESSION["id"];

            $res = $mysqli->query($sql);

            if($res == true){
                echo "<script>alert('Excluído com sucesso!');</script>";
                header("location: ../login/logout.php");
            } else {
                echo "<script>alert('Não foi possível excluir!');</script>";
                header("location: Meu_perfil.php");
            }
    } else if($_SESSION["admin"] == 1){
        $sql = "DELETE FROM usuario 
            WHERE id=" . $_GET["id"];

            $res = $mysqli->query($sql);

            if($res == true){
                echo "<script>alert('Excluído com sucesso!');</script>";
                header("location: Lista_perfis.php");
            } else {
                echo "<script>alert('Não foi possível excluir!');</script>";
                header("location: Meu_perfil.php");
            }
    }
    
?>