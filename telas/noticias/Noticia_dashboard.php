<?php 
  //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
  session_start();

  //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
  set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
  require_once 'config.php';

    $sql = "SELECT *
            FROM noticia
            WHERE id = (?)
            ";

    if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("i", $param_id);
      $param_id = $_GET['id'];

      //Executando a requisição ao banco
      if($stmt->execute()){
        $stmt_res = $stmt->get_result();
      
        if($stmt_res->num_rows == 1){
          $row = $stmt_res->fetch_assoc();
        } else {
            echo "Ops! Algo deu errado (0)";
        }
      } else {
        echo "Ops! Algo deu errado. (1)";
      }
      
      // Fecha a conexão com o banco
      $stmt->close();
    }

  echo '<!DOCTYPE html>';
  echo '<html lang="pt-br">';
  echo '<head>';
  echo '<meta charset="UTF-8">';
  echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  echo '<title>Notícia Dashboard</title>';
  echo '<link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">';
  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
  echo '<link href="../../css/multi-select-tag.css" rel="stylesheet">';
  echo '</head>';
  echo '<body class="bg-light">';
  echo '<nav class="navbar bg-dark sticky-top">';
  echo '<div class="container-fluid">';
  echo '<a class="navbar-brand text-light" href="../Usuario_dashboard.php">Taverna</a>';
  echo "<div style='display:flex;'>";
  echo "<input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>";
  echo "<button class='btn btn-outline-light my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>";
  echo '</div>';
  echo '</form>';
  echo '<button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">';
  echo '<span class="navbar-toggler-icon"></span>';
  echo '</button>';
  echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">';
  echo '<div class="offcanvas-header">';
  echo '<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>';
  echo '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
  echo '</div>';
  echo '<div class="offcanvas-body">';
  echo '<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">';
  echo '<li class="nav-item">';
  echo '<strong>Perfil</strong>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../perfil/Perfil.php">Meu perfil</a>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../perfil/Editar_perfil.php">Editar perfil</a>';
  echo '</li>';
  echo '<li class="nav-item" style="margin-top: 10px;">';
  echo '<strong>Mesas</strong>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../../mesa/Cadastro_mesa.php">Cadastro de mesa</a>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>';
  echo '</li>';
  echo "<li class='nav-item' style='margin-top: 10px;'>";
  echo "<strong>Notícias</strong>";
  echo "<li class='nav-item'>";
  echo "<a class='nav-link' href='Lista_de_noticias.php'>Lista de notícias</a>";
  echo "</li>";
  echo '</ul>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</nav>';
  echo '<div class="container-fluid text-center mt-3" style="width: 800px;">';
  echo '<img src="' .$row["foto"]. '" style="width: 800px;" class="mt-3">';
  echo '<h1 class="p-3">' .$row["titulo"]. '</h1>';
  echo '<h3 class="p-0">' .$row["subtitulo"]. '</h3>';
  echo '<div style="display: flex; justify-content: space-evenly; font-size: 1.2em;" class="p-3">';
  echo '<p class="me-3">Por ' .$row["apelido_admin"]. '</p>';
  echo '<p>' .$row["data"]. '</p>';
  echo '</div>';
  echo '<p style="font-size: 1.2em; text-align: left;" class="mb-5">' .$row["texto"]. '</p>';
  echo '</div>';
  echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
  echo '</body>';
  echo '</html>';

  ?>