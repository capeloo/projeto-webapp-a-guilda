<?php 
    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Validação para impedir que o usuário que não logou entre no dashboard
    if(empty($_SESSION)){
        echo "<script>location.href='login/Login.php';</script>";
    }

    if($_SESSION["admin"] == 0){
      echo "<!DOCTYPE html>";
      echo "<html lang='pt-br'>";
      echo "<head>";
      echo "<meta charset='UTF-8'>";
      echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
      echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
      echo "<title>Dashboard</title>";
      echo "<link rel='shortcut icon' href='./../../assets/fav.png' type='image/x-icon'>";
      echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet'>";
      echo "</head>";
      echo "<body class='bg-light'>";
      echo "<nav class='navbar bg-dark sticky-top'>";
      echo "<div class='container-fluid'>";
      echo "<a class='navbar-brand text-light' href='Usuario_dashboard.php'>Taverna</a>";
      echo "<form class='form-inline' action='../pesquisar.php' method='post'>";
      echo "<div style='display:flex;'>";
      echo "<input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>";
      echo "<button class='btn btn-outline-light my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>";
      echo "</div>";
      echo "</form>";
      echo "<button class='navbar-toggler bg-light' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar' aria-label='Toggle navigation'>";
      echo "<span class='navbar-toggler-icon'></span>";
      echo "</button>";
      echo "<div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasNavbar' aria-labelledby='offcanvasNavbarLabel'>";
      echo "<div class='offcanvas-header'>";
      echo "<h5 class='offcanvas-title' id='offcanvasNavbarLabel'>Menu</h5>";
      echo "<button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
      echo "</div>";
      echo "<div class='offcanvas-body'>";
      echo "<ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>";
      echo "<li class='nav-item'>";
      echo "<strong>Perfil</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../usuario/perfil/Perfil.php'>Meu perfil</a>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='./perfil/Editar_perfil.php'>Editar perfil</a>";
      echo "</li>";
      echo "<li class='nav-item' style='margin-top: 10px;'>";
      echo "<strong>Mesas</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../mesa/Lista_de_mesas.php'>Lista de mesas</a>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../mesa/Cadastro_mesa.php'>Cadastro de mesa</a>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../mesa/Minhas_mesas.php'>Minhas mesas</a>";
      echo "</li>";
      echo "</ul>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</nav>";
      echo "<div class='container-fluid text-center mt-4 bg-light' style='width: 500px;'>";
      echo "<h1 class='p-4'>Olá, " . $_SESSION['apelido'] . "! Sua nova aventura começa aqui.</h1>";
      echo "<div class='p-4'>";
      echo "<a href='login/logout.php' class='btn btn-danger' style='width: 120px;'>Sair</a>";
      echo "</div>";
      echo "</div>";
      echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js'></script>";
      echo "</body>";
      echo "</html>";
    } else if($_SESSION["admin"] == 1){
      echo "<!DOCTYPE html>";
      echo "<html lang='pt-br'>";
      echo "<head>";
      echo "<meta charset='UTF-8'>";
      echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
      echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
      echo "<title>Dashboard</title>";
      echo "<link rel='shortcut icon' href='./../../assets/fav.png' type='image/x-icon'>";
      echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet'>";
      echo "</head>";
      echo "<body class='bg-dark'>";
      echo "<nav class='navbar bg-light sticky-top'>";
      echo "<div class='container-fluid'>";
      echo "<a class='navbar-brand text-dark' href='Usuario_dashboard.php'>Taverna</a>";
      echo "<button class='navbar-toggler bg-light' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar' aria-label='Toggle navigation'>";
      echo "<span class='navbar-toggler-icon'></span>";
      echo "</button>";
      echo "<div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasNavbar' aria-labelledby='offcanvasNavbarLabel'>";
      echo "<div class='offcanvas-header'>";
      echo "<h5 class='offcanvas-title' id='offcanvasNavbarLabel'>Menu</h5>";
      echo "<button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
      echo "</div>";
      echo "<div class='offcanvas-body'>";
      echo "<ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>";
      echo "<li class='nav-item'>";
      echo "<strong>Perfil</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='perfil/Lista_perfis.php'>Lista de perfis</a>";
      echo "</li>";
      echo "<li class='nav-item' style='margin-top: 10px;'>";
      echo "<strong>Denúncia</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='denuncia/Lista_denuncia.php'>Tickets de Denúncia</a>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<li class='nav-item' style='margin-top: 10px;'>";
      echo "<strong>Notícias</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='#'>Escrever Notícia</a>";
      echo "</li>";
      echo "</ul>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</nav>";
      echo "<h1 class='pt-5 text-light text-center'>Olá, " . $_SESSION['apelido'] . "!</h1>";
      echo "<h1 class='text-light text-center'>Este é seu perfil de administrador.</h1>";
      echo "<div class='p-4 text-center'>";
      echo "<a href='login/logout.php' class='btn btn-danger' style='width: 120px;'>Sair</a>";
      echo "</div>";
      echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js'></script>";
      echo "</body>";
      echo "</html>";
    }
?>           

    

