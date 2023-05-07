<?php 
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['id']);
    unset($_SESSION["apelido"]);
    session_destroy();
    header("location: Pagina_inicial.php");
    exit;
?>