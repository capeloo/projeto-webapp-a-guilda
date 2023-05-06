<?php 
    session_start();
    unset($_SESSION['nome']);
    unset($_SESSION['sobrenome']);
    session_destroy();
    header("location: Pagina_inicial.php");
    exit;
?>