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
  echo '<link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">';
  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
  echo '<link href="../../css/multi-select-tag.css" rel="stylesheet">';
  echo '<link href="../../css/standard.css" rel="stylesheet">';
  echo '<link href="../../css/noticia_dashboard.css" rel="stylesheet">';
  echo '</head>';
  echo '<body>';
  echo '<header class="sticky-top" id="h">';
            echo "<a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
            echo "<nav>";
            echo "<div class='container-fluid'>";
            echo '<div>';
            echo "<form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/mesa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu">';
            echo '<a class="dropdown-item" href="../mesa/Lista_de_mesas.php">Lista de mesas</a>';
            echo '<a class="dropdown-item" href="../mesa/Minhas_mesas.php">Minhas mesas</a>';
            echo '<a class="dropdown-item" href="../mesa/Cadastro_mesa.php">Cadastrar mesa</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="Lista_de_noticias.php">Feed de notícias</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="../usuario/perfil/Perfil.php">Meu perfil</a>';
            echo '<a class="dropdown-item" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>';
            echo '<hr class="dropdown-divider">';
            echo '<a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>';
            echo '</div>';
            echo '</div>';
            echo "</div>";
            echo '</div>';
            echo "</nav>";
            echo '</header>';
            echo '<main>';
  echo '<div style="width: 1080px; padding: 0px; margin: auto;">';
  echo '<div style="display: flex;">';
  echo '<img src="../../assets/images/moldura-esquerda.png" style="width: 155px; height:155px; position: relative; top: 19em; left: 9em;">';
  echo '<img src="' .$row["foto"]. '" style="width: 800px; height:400px; border-radius: 0.5em; margin-top: 3em;">';
  echo '<img src="../../assets/images/moldura-direita.png" style="width: 145px; height:145px; position: relative; top: 2em; left: -8.5em;">';
  echo '</div>';
  echo '<h1 id="titulo">' .$row["titulo"]. '</h1>';
  echo '<h3>' .$row["subtitulo"]. '</h3>';
  echo '<div id="i" style="display: flex; justify-content: space-evenly; font-size: 1.2em;" class="p-3">';
  echo '<p class="me-3">Por ' .$row["apelido_admin"]. '</p>';
  echo '<p>' .$row["data"]. '</p>';
  echo '</div>';
  echo '<p style="font-size: 1.4em; text-indent: 1em; margin-top: 1em; text-align: left; width: 1000px; padding-bottom: 3em;">' .$row["texto"]. '</p>';
  echo '</div>';
  echo '</main>';
  echo '<footer>';
            echo '<div class="container-fluid">';
            echo '<p>&copy; A Guilda. Siga em frente!</p>';
            echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>';
            echo '</div>';
            echo '</footer>';
  echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
  echo '</body>';
  echo '</html>';

  ?>