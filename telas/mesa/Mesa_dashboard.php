<?php 
  //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
  session_start();

  //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
  set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
  require_once 'config.php';

  if($_SESSION["admin"] == 0){
    $sql = "SELECT *
          FROM mesa
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
  echo '<title>Mesa dashboard</title>';
  echo '<link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">';
  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
  echo '<link href="../../css/multi-select-tag.css" rel="stylesheet">';
  echo '<link href="../../css/standard.css" rel="stylesheet">';
  echo '<link href="../../css/mesa_dashboard.css" rel="stylesheet">';
  echo '</head>';
  echo '<body>';
  echo '<header class="sticky-top" id="h">';
            echo "<a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
            echo "<nav>";
            echo "<div class='container-fluid'>";
            echo '<div>';
            echo '<img src="../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">';
            echo "<form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu">';
            echo '<a class="dropdown-item" href="Lista_de_mesas.php">Lista de mesas</a>';
            echo '<a class="dropdown-item" href="Minhas_mesas.php">Minhas mesas</a>';
            echo '<a class="dropdown-item" href="Cadastro_mesa.php">Cadastrar mesa</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="../noticias/Lista_de_noticias.php">Feed de notícias</a>';
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
  echo '<div class="container-fluid text-center">';
  echo '<form action="' .htmlspecialchars($_SERVER["PHP_SELF"]). '" method="post">';
  echo '<div class="input-group" style="width: 350px;">';
  echo '<div style="display: flex; align-items: center; width: 112vw;">';
  echo '<img src="../../assets/images/moldura-esquerda.png" style="width: 155px; height:155px; position: relative; top: 12.5em; left: 2.7em; z-index: 2;">';
  echo '<img src="' .$row["foto"]. '" style="width: 1150px; height:500px; border-radius: 0.5em; margin-top: 2em; position: relative; left: -6.15em;">';
  echo '<img src="../../assets/images/moldura-direita.png" style="width: 145px; height:145px; position: relative; top: -11em; left: -14.5em; z-index: 2;">';
  echo '</div>';
  echo '</div>';

  echo '<div style="display: flex; justify-content: space-between;" id="titulo">';
  echo '<div style="padding: 1em; padding-left: 6em;">';
  echo '<div style="width: 400px; text-align: left;">';
  echo '<h1>' .$row["nome_campanha"]. '</h1>';
  echo '</div>';
  echo '<div style="width: 400px; display: flex;">';
  echo '<h2>' .$row["data"]. '</h2>';
  echo '<h2>' .$row["hora"]. '</h2>';
  echo '</div>';
  echo '</div>';
  echo '<div style="padding: 1em; display: flex;">';
  echo '<div style="text-align:center; margin-right: 0.5em;">';
  echo '<img src="../../assets/images/icons8-hourglass-100.png" style="width:3.5em; height: 3em; margin-top: 0.7em;">';
  echo '<p>'.$row["duracao"].'</p>';
  echo '</div>';
  echo '<div style="text-align:center; margin-right: 0.5em;">';
  echo '<img src="../../assets/images/icons8-year-of-dragon-100.png" style="width:3.5em; height: 3em;margin-top: 0.7em;">';
  echo '<p>'.$row["sistema"].'</p>';
  echo '</div>';
  echo '<div style="text-align:center; margin-right: 0.5em;">';
  echo '<img src="../../assets/images/icons8-battle-100.png" style="width:3.5em; height: 3em;
        margin-top: 0.7em;">';
  echo '<p>'.$row["nivel_jogadores"].'</p>';
  echo '</div>';
  echo '<div style="text-align:center; margin-right: 1.5em;">';
  echo '<img src="../../assets/images/classificacao-'.$row["classificacao_indicativa"].'-anos-logo.png" style="width:3.5em; height: 3em; margin-top: 0.7em; border-radius: 0.85em;">';
  echo '<p>'.$row["classificacao_indicativa"].'</p>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  echo '<div id="content">';
  echo '<div id="section-1">';
  echo '<div class="input-group" id="sinopse" style="width: 400px;">';
  echo '<h1>Sinopse</h1>';
  echo '<p>' .$row["sinopse"]. '</p>';
  echo '</div>';
  echo '<div class="input-group" id="requisitos" style="width: 400px;">';
  echo '<h1>Requisitos Mínimos</h1>';
  echo '<p>' .$row["requisitos"]. '</p>';
  echo '</div>';
  echo '</div>';
  echo '<div id="section-2">';
  echo '<div style="display: flex;">';
  echo '<h1>Participantes</h1>';
  echo '<h1>1/6</h1>';
  echo '</div>';
  echo '<div>';
  echo '<div style="display: flex; justify-content: space-between;">';
  echo '<p>'.$row["nome_mestre"].'</p>';
  echo '<p>Mestre</p>';
  echo '<p>Discord#1111</p>';
  echo '</div>';
  echo '</div>';
  echo '<div>';
  echo '<a href="inscrever.php?id=' .$row['id']. '" class="btn btn-success mt-5">Inscrever-se</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

  echo '</div>';  
  echo '</form>';
  echo '</main>';
  echo '<footer>';
            echo '<div class="container-fluid">';
            echo '<p>&copy; A Guilda. Siga em frente!</p>';
            echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>';
            echo '</div>';
            echo '</footer>';
  echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
  echo '<script src="../../js/multi-select-tag.js"></script>';
  echo "<script> new MultiSelectTag('theme') </script>";
  echo '</body>';
  echo '</html>';
  } else if($_SESSION["admin"] == 1){
    $sql = "SELECT *
          FROM mesa
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
    echo '<title>Mesa dashboard</title>';
    echo '<link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">';
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '<link href="../../css/multi-select-tag.css" rel="stylesheet">';
    echo '<link href="../../css/standard.css" rel="stylesheet">';
    echo '<link href="../../css/mesa_dashboard.css" rel="stylesheet">';
    echo '</head>';
    echo '<body>';
    echo '<header class="sticky-top" id="h">';
      echo "<a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
      echo "<nav>";
      echo "<div class='container-fluid'>";
      echo '<div>';
      echo '<img src="../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">';
      echo "<form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>";
      echo "<div style='display:flex;'>";
      echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
      echo "</div>";
      echo "</form>";
      echo '<div class="dropdown">';
      echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>';
      echo '<div class="dropdown-menu">';
      echo '<a class="dropdown-item" href="../mesa/Lista_de_mesas.php">Lista de mesas</a>';
      echo '</div>';
      echo '</div>';
      echo '<div class="dropdown">';
      echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>';
      echo '<div class="dropdown-menu dropdown-menu-lg-end">';
      echo '<a class="dropdown-item" href="../noticias/Escrever_noticia.php">Escrever notícia</a>';
      echo '</div>';
      echo '</div>';
      echo '<div class="dropdown">';
      echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-identificação-não-verificada-100.png" style="width: 2.8em;"></button>';
      echo '<div class="dropdown-menu dropdown-menu-lg-end">';
      echo '<a class="dropdown-item" href="../usuario/denuncia/Lista_denuncia.php">Tickets de denúncia</a>';
      echo '</div>';
      echo '</div>';
      echo '<div class="dropdown">';
      echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>';
      echo '<div class="dropdown-menu dropdown-menu-lg-end">';
      echo '<a class="dropdown-item" href="../usuario/perfil/Lista_perfis.php">Lista de perfis</a>';
      echo '<hr class="dropdown-divider">';
      echo '<a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>';
      echo '</div>';
      echo '</div>';
      echo "</div>";
      echo '</div>';
      echo "</nav>";
      echo '</header>';
    echo '<main>';
    echo '<div class="container-fluid text-center">';
    echo '<form action="' .htmlspecialchars($_SERVER["PHP_SELF"]). '" method="post">';
    echo '<div class="input-group" style="width: 350px;">';
    echo '<div style="display: flex; align-items: center; width: 112vw;">';
    echo '<img src="../../assets/images/moldura-esquerda.png" style="width: 155px; height:155px; position: relative; top: 12.5em; left: 2.7em; z-index: 2;">';
    echo '<img src="' .$row["foto"]. '" style="width: 1150px; height:500px; border-radius: 0.5em; margin-top: 2em; position: relative; left: -6.15em;">';
    echo '<img src="../../assets/images/moldura-direita.png" style="width: 145px; height:145px; position: relative; top: -11em; left: -14.5em; z-index: 2;">';
    echo '</div>';
    echo '</div>';
  
    echo '<div style="display: flex; justify-content: space-between;" id="titulo">';
    echo '<div style="padding: 1em; padding-left: 6em;">';
    echo '<div style="width: 400px; text-align: left;">';
    echo '<h1>' .$row["nome_campanha"]. '</h1>';
    echo '</div>';
    echo '<div style="width: 400px; display: flex;">';
    echo '<h2>' .$row["data"]. '</h2>';
    echo '<h2>' .$row["hora"]. '</h2>';
    echo '</div>';
    echo '</div>';
    echo '<div style="padding: 1em; display: flex;">';
    echo '<div style="text-align:center; margin-right: 0.5em;">';
    echo '<img src="../../assets/images/icons8-hourglass-100.png" style="width:3.5em; height: 3em; margin-top: 0.7em;">';
    echo '<p>'.$row["duracao"].'</p>';
    echo '</div>';
    echo '<div style="text-align:center; margin-right: 0.5em;">';
    echo '<img src="../../assets/images/icons8-year-of-dragon-100.png" style="width:3.5em; height: 3em;margin-top: 0.7em;">';
    echo '<p>'.$row["sistema"].'</p>';
    echo '</div>';
    echo '<div style="text-align:center; margin-right: 0.5em;">';
    echo '<img src="../../assets/images/icons8-battle-100.png" style="width:3.5em; height: 3em;
          margin-top: 0.7em;">';
    echo '<p>'.$row["nivel_jogadores"].'</p>';
    echo '</div>';
    echo '<div style="text-align:center; margin-right: 1.5em;">';
    echo '<img src="../../assets/images/classificacao-'.$row["classificacao_indicativa"].'-anos-logo.png" style="width:3.5em; height: 3em; margin-top: 0.7em; border-radius: 0.85em;">';
    echo '<p>'.$row["classificacao_indicativa"].'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  
    echo '<div id="content">';
    echo '<div id="section-1">';
    echo '<div class="input-group" id="sinopse" style="width: 400px;">';
    echo '<h1>Sinopse</h1>';
    echo '<p>' .$row["sinopse"]. '</p>';
    echo '</div>';
    echo '<div class="input-group" id="requisitos" style="width: 400px;">';
    echo '<h1>Requisitos Mínimos</h1>';
    echo '<p>' .$row["requisitos"]. '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div id="section-2">';
    echo '<div style="display: flex;">';
    echo '<h1>Participantes</h1>';
    echo '<h1>1/6</h1>';
    echo '</div>';
    echo '<div>';
    echo '<div style="display: flex; justify-content: space-between;">';
    echo '<p>'.$row["nome_mestre"].'</p>';
    echo '<p>Mestre</p>';
    echo '<p>Discord#1111</p>';
    echo '</div>';
    echo '</div>';
    echo '<div>';
    echo '<a href="anunciar.php?id=' .$row["id"]. '"class="btn btn-primary mt-5 me-3" style="width: 120px;">Anunciar</a>';
    echo '<a href="retirar_anuncio.php?id=' .$row["id"]. '"class="btn btn-danger mt-5" style="width: 120px;">Retirar</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  
    echo '</div>';  
    echo '</form>';
    echo '</main>';
    echo '<footer>';
              echo '<div class="container-fluid">';
              echo '<p>&copy; A Guilda. Siga em frente!</p>';
              echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>';
              echo '</div>';
              echo '</footer>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
    echo '<script src="../../js/multi-select-tag.js"></script>';
    echo "<script> new MultiSelectTag('theme') </script>";
    echo '</body>';
    echo '</html>';
  }
?>

  