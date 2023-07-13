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
            echo "<form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/mesa.png" style="width: 2.8em;"></button>';
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
  echo '<img src="../../assets/images/moldura-esquerda.png" style="width: 155px; height:155px; position: relative; top: 4.5em; left: 2.7em; z-index: 2;">';
  echo '<img src="' .$row["foto"]. '" style="width: 1150px; height:500px; border-radius: 0.5em; margin-top: 3em; position: relative; left: -6.15em; top: -8.5em;">';
  echo '<img src="../../assets/images/moldura-direita.png" style="width: 145px; height:145px; position: relative; top: -18em; left: -14.5em; z-index: 2;">';
  echo '</div>';
  echo '</div>';
  echo '<div style="display: flex;" id="titulo">';
  echo '<div>';
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
  echo '</div>';
  
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<select name="classificacao" class="form-control" disabled>';
  echo '<option>' .$row["classificacao_indicativa"]. '</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<input type="number" class="form-control" name="vagas" value="' .$row["numero_vagas"]. '" disabled>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<select name="nivel" class="form-control" disabled>';
  echo '<option>' .$row["nivel_jogadores"]. '</option>';
  echo '</select>';
  echo '</div>';

  echo '<div class="input-group mx-auto p-2" id="sinopse" style="width: 400px;">';
  echo '<h1>Sinopse</h1>';
  echo '<p>' .$row["sinopse"]. '</p>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" id="requisitos" style="width: 400px;">';
  echo '<h1>Requisitos Mínimos</h1>';
  echo '<p>' .$row["requisitos"]. '</p>';
  echo '</div>';
  echo '</div>';  
  echo '</form>';
  echo '<div>';
  echo '<a href="inscrever.php?id=' .$row['id']. '" class="btn btn-success mt-5">Inscrever-se</a>';
  echo '</div>';
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
  echo '<link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">';
  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
  echo '<link href="../../css/multi-select-tag.css" rel="stylesheet">';
  echo '</head>';
  echo '<body class="bg-dark">';
  echo '<nav class="navbar bg-light sticky-top">';
  echo '<div class="container-fluid">';
  echo '<a class="navbar-brand text-dark" href="../usuario/Usuario_dashboard.php">Taverna</a>';
  echo "<form class='form-inline' action='../pesquisar.php' method='post'>";
  echo "<div style='display:flex;'>";
  echo "<input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>";
  echo "<button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>";
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
  echo '<a class="nav-link" href="../usuario/perfil/Lista_perfis.php">Lista de perfis</a>';
  echo '</li>';
  echo '<li class="nav-item" style="margin-top: 10px;">';
  echo '<li class="nav-item">';
  echo '<strong>Mesa</strong>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="Lista_de_mesas.php">Lista de mesas</a>';
  echo '</li>';
  echo "<li class='nav-item' style='margin-top: 10px;'>";
  echo '<strong>Denúncia</strong>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="../usuario/denuncia/Lista_denuncia.php">Tickets de denúncia</a>';
  echo '</li>';
  echo '<li class="nav-item" style="margin-top: 10px;">';
  echo '<li class="nav-item">';
  echo '<strong>Notícias</strong>';
  echo '</li>';
  echo '<li class="nav-item">';
  echo '<a class="nav-link" href="#">Escrever notícia</a>';
  echo '</li>';
  echo '</ul>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</nav>';
  echo '<div class="container-fluid text-center mt-3">';
  echo '<h1 class="p-3 text-light">Mesa</h1>';
  echo '<form action="' .htmlspecialchars($_SERVER["PHP_SELF"]). '" method="post">';
  echo '<div class="row" style="height: 300px;">';
  echo '<div class="col">';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text" style="width: 283px; border-radius: 5px;justify-content:center;">Tema</span>';
  echo '<select name="tema" id="theme" multiple>';
  echo '<option>Ação</option>';
  echo '<option>Aventura</option>';
  echo '<option>Horror</option>';
  echo '<option>Mistério</option>';
  echo '<option>Body Building</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 350px;">';
  echo '<span class="input-group-text" style="width: 350px; border-radius: 5px 5px 0px 0px;">Foto</span>'; 
  echo '<img src="' .$row["foto"]. '" alt="foto-perfil" name="foto" class="img" width="335px" height="260px" style="border-radius: 0px 0px 5px 5px;">';
  echo '</div>';
  echo '</div>';  
  echo '<div class="col">';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Duração</span>';
  echo '<select name="duracao" class="form-control" disabled>';
  echo '<option>' .$row["duracao"]. '</option>';
  echo '<option>One-shot</option>';
  echo '<option>Curta</option>';
  echo '<option>Média</option>';
  echo '<option>Longa</option>';
  echo '<option>Odisseia</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Classificação Indicativa</span>';
  echo '<select name="classificacao" class="form-control" disabled>';
  echo '<option>' .$row["classificacao_indicativa"]. '</option>';
  echo '<option>L</option>';
  echo '<option>10</option>';
  echo '<option>12</option>';
  echo '<option>14</option>';
  echo '<option>16</option>';
  echo '<option>18</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Número de vagas</span>';
  echo '<input type="number" class="form-control" name="vagas" value="' .$row["numero_vagas"]. '" disabled>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Nível dos jogadores</span>';
  echo '<select name="nivel" class="form-control" disabled>';
  echo '<option>' .$row["nivel_jogadores"]. '</option>';
  echo '<option>Livre</option>';
  echo '<option>Iniciante</option>';
  echo '<option>Intermediário</option>';
  echo '<option>Avançado</option>';
  echo '<option>Mestre</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Data</span>';
  echo '<input type="date" class="form-control" name="data" value="' .$row["data"]. '" disabled>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 300px;">';
  echo '<span class="input-group-text">Hora</span>';
  echo '<input type="time" class="form-control" name="hora" value="' .$row["hora"]. '" disabled>';
  echo '</div>';
  echo '</div>';
  echo '<div class="col">';
  echo '<div class="input-group mx-auto p-2" style="width:  400px;">';
  echo '<span class="input-group-text">Nome da campanha</span>';
  echo '<input type="text" name="nome_campanha" class="form-control" value="' .$row["nome_campanha"]. '" disabled>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 400px;">';
  echo '<span class="input-group-text">Sistema</span>';
  echo '<input type="text" name="sistema" class="form-control" value="' .$row["sistema"]. '" disabled>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 400px;">';
  echo '<span class="input-group-text">Sinopse</span>';
  echo '<textarea name="sinopse" class="form-control" disabled>' .$row["sinopse"]. '</textarea>';
  echo '</div>';
  echo '<div class="input-group mx-auto p-2" style="width: 400px;">';
  echo '<span class="input-group-text">Requisitos</span>';
  echo '<textarea name="requisitos" class="form-control" disabled>' .$row["requisitos"]. '</textarea>';
  echo '</div>';
  echo '</div>';
  echo '</div>';    
  echo '</form>';
  echo '<div>';
  echo '<a href="anunciar.php?id=' .$row["id"]. '"class="btn btn-primary mt-5 me-3" style="width: 120px;">Anunciar</a>';
  echo '<a href="retirar_anuncio.php?id=' .$row["id"]. '"class="btn btn-danger mt-5" style="width: 120px;">Retirar</a>';
  echo '</div>'; 
  echo '</div>';
  echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
  echo '<script src="../../js/multi-select-tag.js"></script>';
  echo "<script> new MultiSelectTag('theme') </script>";
  echo '</body>';
  echo '</html>';
  }
?>

  