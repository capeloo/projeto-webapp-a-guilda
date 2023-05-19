<?php 
    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Validação para impedir que o usuário que não logou entre no dashboard
    if(empty($_SESSION)){
        echo "<script>location.href='login/Login.php';</script>";
    }
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Barra de navegação -->
  <nav class="navbar bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="Usuario_dashboard.php">Taverna</a>
      <!-- Offcanvas -->
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <strong>Perfil</strong>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./perfil/Editar_perfil.php">Meu perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./perfil/Editar_perfil.php">Editar perfil</a>
            </li>
            <li class="nav-item" style="margin-top: 10px;">
              <strong>Mesas</strong>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../mesa/Lista_de_mesas.php">Lista de mesas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../mesa/Cadastro_mesa.php">Cadastro de mesa</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-4 bg-light" style="width: 500px;">
        <h1 class="p-4">Olá, <?php echo $_SESSION['apelido'] ?>! Sua nova aventura começa aqui.</h1>
        <div class="p-4">
            <a href="login/logout.php" class="btn btn-danger" style="width: 100px;">Sair</a>
        </div>
    </div>

    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>