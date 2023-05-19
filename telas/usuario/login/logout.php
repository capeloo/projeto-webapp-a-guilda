<?php 
    //Arquivo que desloga o usuário
    
    // 1. Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    // 2. Desconfigurar as variáveis de sessão
    unset($_SESSION['loggedIn']);
    unset($_SESSION['id']);
    unset($_SESSION["apelido"]);

    // 3. Destrói a sessão
    session_destroy();

    // 4. Redireciona para a página inicial
    header("location: ../../../index.php");

    // 5. Termina o script
    exit;
?>