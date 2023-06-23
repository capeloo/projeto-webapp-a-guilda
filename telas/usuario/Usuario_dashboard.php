<?php 
    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

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
      echo "<li class='nav-item' style='margin-top: 10px;'>";
      echo "<strong>Notícias</strong>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='noticias/Lista_de_noticias.php'>Lista de notícias</a>";
      echo "</li>";
      echo "</ul>";
      echo "<div class='p-4 text-center' style='margin-top:50px;'>";
      echo "<a href='login/logout.php' class='btn btn-danger' style='width: 120px;'>Sair</a>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</nav>";

      //Anúncios

      $sql = "SELECT foto, nome_campanha, sinopse
              FROM mesa
              WHERE anuncio = 1
              ORDER BY data
              LIMIT 3
              ";

      $stmt = $mysqli->prepare($sql);
      $stmt->execute();
      $stmt_res = $stmt->get_result();

      echo '<div class="container-fluid bg-dark p-0" style="width:100%; border-radius: 0px 0px 10px 10px;">';
      echo '<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">';
      echo '<ol class="carousel-indicators">';
      echo '<ul style="display: flex; list-style-type: none;">';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>';
      echo '</ol>';
      echo '</ul>';
      echo '<div class="carousel-inner">';
      echo '<div class="carousel-item active">';
      
      $cont = 0;

      while ($row = $stmt_res->fetch_assoc()) {
        $cont++;
        echo '<img class="d-block w-100" style="height: 480px; margin: auto;" src="' .$row['foto']. '" alt="First slide">';
        echo '<div class="carousel-caption text-start mb-4">';
        echo '<h1>' .$row["nome_campanha"]. '</h1>';
        echo '<h3>' .$row["sinopse"]. '</h3>';
        echo '</div>';
        echo '</div>';
        if($cont < 3){
          echo '<div class="carousel-item">';
        } else {};
      }
      
      echo '</div>';
      echo  '<a class="carousel-control-prev" style="background: linear-gradient(to left, #21252900, #212529);" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">';
      echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
      echo '</a>';  
      echo '<a class="carousel-control-next" style="background: linear-gradient(to right, #21252900, #212529);" href="#carouselExampleIndicators" role="button" data-bs-slide="next">';
      echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
      echo '</a>';
      echo '</div>';
      echo '</div>';

      //Minhas mesas
      $id = $_SESSION["id"];

      //Prepara a requisição ao banco
      $sql = "SELECT * 
              FROM mesa
              WHERE id_mestre = $id
              LIMIT 3";

      if($stmt = $mysqli->query($sql)){
        $qtd = $stmt->num_rows;

        //Renderiza os dados na forma de tabela
        if($qtd > 0){
        echo '<div class="row container-fluid text-center mt-4 bg-dark" style="margin:auto; width: 100%;">';
        echo '<h1 class="p-2 mt-4 text-light">Minhas mesas</h1>';
        echo '<div class="col">';
        echo '<h2 class="p-2 text-start ms-5 mt-3 text-light">Mestrando</h2>';  
        echo "<table class='table table-hover table-striped table-bordered bg-light mb-3' style='width: 1100px;margin: auto;'>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Sistema</th>";
        echo "<th>Sinopse</th>";
        echo "<th>Duração</th>";
        echo "<th>Tema</th>";
        echo "<th>Classificação Indicativa</th>";
        echo "<th>Vagas</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        while($row = $stmt->fetch_object()){
          echo "<tr>";
          echo "<td>" . $row->nome_campanha . "</td>";
          echo "<td>" . $row->sistema . "</td>";
          echo "<td>" . $row->sinopse . "</td>";
          echo "<td>" . $row->duracao . "</td>";
          echo "<td>" . $row->tema . "</td>";
          echo "<td>" . $row->classificacao_indicativa . "</td>";
          echo "<td>" . $row->numero_vagas . "</td>";
          echo "<td>
                  <button class='btn btn-success' onclick=\"location.href='../mesa/Mesa_dashboard.php?id=".$row->id."';\">Acesse</button>
                </td>";        
          echo "</tr>";
          }
        echo "</table>";
        } else {
          echo '<div class="row container-fluid text-center mt-4 bg-dark" style="margin:auto; width: 100%;">';
          echo '<h1 class="p-2 mt-4 text-light">Minhas mesas</h1>';
          echo '<div class="col">';
          echo '<h2 class="p-2 text-center text-light">Mestrando</h2>';  
          echo "<h4 class='text-danger text-center p-2 mb-5' style='margin: auto;'>Você ainda não está inscrito em nenhuma mesa!</h4>";
        }
      } 
        
      $sql = "SELECT mesas
              FROM usuario
              WHERE id = $id";

      $stmt = $mysqli->prepare($sql);
      $stmt->execute();
      $stmt_res = $stmt->get_result();
      $row = $stmt_res->fetch_assoc();

      if(!empty($row["mesas"])){
        $mesas_str = rtrim($row["mesas"], ",");

        if(strlen($mesas_str) > 1){
          $sql = "SELECT *
                  FROM mesa
                  WHERE id 
                  IN ('$mesas_str')
                  LIMIT 3";
                  
          $stmt = $mysqli->query($sql);
            
          $qtd = $stmt->num_rows;
        } else {
          $sql = "SELECT *
                  FROM mesa
                  WHERE id = $mesas_str";
                    
          $stmt = $mysqli->query($sql);
            
          $qtd = $stmt->num_rows;
          }
  
        //Renderiza os dados na forma de tabela
        if($qtd > 0){
          echo '</div>';
          echo '<div class="col">';
          echo '<h2 class="p-2 text-start ms-5 mt-3 text-light">Participando</h2>';  
          echo "<table class='table table-hover table-striped table-bordered mb-5 bg-light' style='width: 1100px; margin: auto;'>";
          echo "<tr>";
          echo "<th>Nome</th>";
          echo "<th>Sistema</th>";
          echo "<th>Sinopse</th>";
          echo "<th>Duração</th>";
          echo "<th>Tema</th>";
          echo "<th>Classificação Indicativa</th>";
          echo "<th>Vagas</th>";
          echo "<th>Ações</th>";
          echo "</tr>";
          while($row = $stmt->fetch_object()){
            echo "<tr>";
            echo "<td>" . $row->nome_campanha . "</td>";
            echo "<td>" . $row->sistema . "</td>";
            echo "<td>" . $row->sinopse . "</td>";
            echo "<td>" . $row->duracao . "</td>";
            echo "<td>" . $row->tema . "</td>";
            echo "<td>" . $row->classificacao_indicativa . "</td>";
            echo "<td>" . $row->numero_vagas . "</td>";
            echo "<td>
                    <button class='btn btn-success' onclick=\"location.href='../mesa/Mesa_dashboard.php?id=".$row->id."';\">Acesse</button>
                  </td>";        
            echo "</tr>";
            }
            echo "</table>";
            echo '</div>';
            echo '</div>';
        } else {
          echo '</div>';
          echo '<div class="col">';
          echo '<h2 class="p-2 text-center text-light">Participando</h2>';  
          echo "<h4 class='text-danger text-center p-2 mb-5' style='margin: auto;'>Você ainda não está inscrito em nenhuma mesa!</h4>";
          echo '</div>';
          }         
      } else {
        echo '</div>';
        echo '<div class="col">';
        echo '<h2 class="p-2 text-center text-light">Participando</h2>';  
        echo "<h4 class='text-danger text-center p-2 mb-5' style='margin: auto;'>Você ainda não está inscrito em nenhuma mesa!</h4>";
        echo "</div>";
      }

      //Notícias
      $id = $_SESSION["id"];

      //Prepara a requisição ao banco
      $sql = "SELECT * 
              FROM noticia
              ORDER BY data
              LIMIT 3";

      if($stmt = $mysqli->query($sql)){
        $qtd = $stmt->num_rows;

        //Renderiza os dados na forma de tabela
        if($qtd > 0){
        echo '<div class="container-fluid text-center bg-dark p-4 mt-4" style="margin:auto; width: 100%;">';
        $cont = 0;
        while($row = $stmt->fetch_object()){
          if($cont < 1){
            $cont++;
            echo '<h1 class="p-2 mt-4 text-light">Notícias</h1>';
            echo '<div style="display: flex;">';
            echo '<div style="width: 10%;"></div>';
            echo '<div class="mt-5" style="width: 400px; height: 200px; background: url(../../assets/h1.png); background-size: cover; margin: auto;">';
            echo '</div>';
            echo '<div style="width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-right:40px solid #F8F9FA;" class="mt-5">';
            echo '</div>';
            echo '<div class="bg-light p-3 mt-5 text-start ms-0 me-5" style="width: 600px; border-radius: 0px; margin: auto; margin-right: 0px;">';
            echo '<p class="ms-3 mb-0" style="font-size: 1.1em;">' .$row->data. '</p>';
            echo '<a href="noticias/Noticia_dashboard.php?id=' .$row->id. '" style="font-size: 1.3em;text-decoration: underline;" class="text-dark"><h1 class="ms-3">' .$row->titulo. '</h1></a>';
            echo '<h4 class="ms-3">' .$row->subtitulo. '</h4>';
            echo '</div>';
            echo '<div style="width: 10%;"></div>';
            echo '</div>';
          } else if($cont < 2){
            $cont++;
            echo '<div style="display: flex;">';
            echo '<div style="width: 10%;"></div>';
            echo '<div class="bg-light p-3 mt-5 text-start ms-0 me-0" style="width: 600px; border-radius: 0px; margin: auto; margin-right: 0px;">';
            echo '<p class="ms-3 mb-0" style="font-size: 1.1em;">' .$row->data. '</p>';
            echo '<a href="noticias/Noticia_dashboard.php?id=' .$row->id. '" style="font-size: 1.3em;text-decoration: underline;" class="text-dark"><h1 class="ms-3">' .$row->titulo. '</h1></a>';
            echo '<h4 class="ms-3">' .$row->subtitulo. '</h4>';
            echo '</div>';
            echo '<div style="width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-left:40px solid #F8F9FA;" class="mt-5">';
            echo '</div>';
            echo '<div class="mt-5" style="width: 350px; height: 200px; background: url(../../assets/h2.png); background-size: cover; margin: auto;">';
            echo '</div>';
            echo '<div style="width: 10%;"></div>';
            echo '</div>';
          } else if($cont < 3){
            $cont++;
            echo '<div style="display: flex;" class="mb-4">';
            echo '<div style="width: 10%;"></div>';
            echo '<div class="mt-5" style="width: 400px; height: 200px; background: url(../../assets/h3.png); background-size: cover; margin: auto;">';
            echo '</div>';
            echo '<div style="width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-right:40px solid #F8F9FA;" class="mt-5">';
            echo '</div>';
            echo '<div class="bg-light p-3 mt-5 text-start ms-0 me-5" style="width: 600px; border-radius: 0px; margin: auto; margin-right: 0px;">';
            echo '<p class="ms-3 mb-0" style="font-size: 1.1em;">' .$row->data. '</p>';
            echo '<a href="noticias/Noticia_dashboard.php?id=' .$row->id. '" style="font-size: 1.3em;text-decoration: underline;" class="text-dark"><h1 class="ms-3">' .$row->titulo. '</h1></a>';
            echo '<h4 class="ms-3">' .$row->subtitulo. '</h4>';
            echo '</div>';
            echo '<div style="width: 10%;"></div>';
            echo '</div>';
          }
          }
    
        } else {
          echo '<div class="row container-fluid text-center mt-4 mb-4 bg-dark" style="margin:auto; width: 100%;">';
          echo '<h1 class="p-2 mt-4 text-light">Minhas mesas</h1>';
          echo '<div class="col">';
        }
      } 

      echo '</div>';
      echo '<footer class="container-fluid bg-dark p-2 mt-5" style="height: 60px; display: flex;">';
      echo '<div class="row" style="width: 100%; margin: auto;">';
      echo '<div class="col">';
      echo '<p class="text-light text-start mt-2" style="margin: 0px; font-size: 1.2em;">Que a Guilda o acompanhe!</p>';
      echo '</div>';
      echo '<div class="col">';
      echo '<p class="mt-2 text-end"><a href="https://www.instagram.com/aguilda_smd/" target="_blank"class="text-light mt-2" style="font-size: 1.2em;">Siga nossas redes!</a></p>';
      echo '</div>';
      echo '</footer>';
      echo "<script src='../../js/bootstrap.min.js'></script>";
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
      echo "<form class='form-inline' action='../pesquisar.php' method='post'>";
      echo "<div style='display:flex;'>";
      echo "<input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>";
      echo "<button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>";
      echo '</div>';
      echo '</form>';
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
      echo "<li class='nav-item'>";
      echo "<strong>Mesa</strong>";
      echo "</li>";
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../mesa/Lista_de_mesas.php'>Lista de mesas</a>";
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
      echo "<a class='nav-link' href='noticias/Escrever_noticia.php'>Escrever Notícia</a>";
      echo "</li>";
      echo "</ul>";
      echo "<div class='p-4 text-center' style='margin-top:100px;'>";
      echo "<a href='login/logout.php' class='btn btn-danger' style='width: 120px;'>Sair</a>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</nav>";

      //Anúncios

      $sql = "SELECT foto, nome_campanha, sinopse
              FROM mesa
              WHERE anuncio = 1
              ORDER BY timestamp DESC
              LIMIT 3
              ";

      $stmt = $mysqli->prepare($sql);
      $stmt->execute();
      $stmt_res = $stmt->get_result();

      echo '<div class="container-fluid bg-dark p-0" style="width:100%; border-radius: 0px 0px 10px 10px;">';
      echo '<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">';
      echo '<ol class="carousel-indicators">';
      echo '<ul style="display: flex; list-style-type: none;">';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>';
      echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>';
      echo '</ol>';
      echo '</ul>';
      echo '<div class="carousel-inner">';
      echo '<div class="carousel-item active">';
      
      $cont = 0;

      while ($row = $stmt_res->fetch_assoc()) {
        $cont++;
        echo '<img class="d-block w-100" style="height: 500px; margin: auto;" src="' .$row['foto']. '" alt="First slide">';
        echo '<div class="carousel-caption text-start mb-4">';
        echo '<h1>' .$row["nome_campanha"]. '</h1>';
        echo '<h3>' .$row["sinopse"]. '</h3>';
        echo '</div>';
        echo '</div>';
        if($cont < 3){
          echo '<div class="carousel-item">';
        } else {};
      }
      
      echo '</div>';
      echo  '<a class="carousel-control-prev" style="background: linear-gradient(to left, #21252900, #212529);" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">';
      echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
      echo '</a>';  
      echo '<a class="carousel-control-next" style="background: linear-gradient(to right, #21252900, #212529);" href="#carouselExampleIndicators" role="button" data-bs-slide="next">';
      echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
      echo '</a>';
      echo '</div>';
      echo '</div>';

      echo "<h1 class='pt-4 text-light text-center'>Olá, " . $_SESSION['apelido'] . "!</h1>";
      echo "<h1 class='text-light text-center mb-5'>Este é seu perfil de administrador.</h1>";
      echo '<footer class="container-fluid bg-light p-2" style="height: 60px; display: flex; position: relative;
      bottom: 0;">';
      echo '<div class="row" style="width: 100%; margin: auto;">';
      echo '<div class="col">';
      echo '<p class="text-dark mt-2" style="margin: 0px; font-size: 1.2em;">Que a Guilda o acompanhe!</p>';
      echo '</div>';
      echo '<div class="col">';
      echo '<p class="mt-2 text-end"><a href="https://www.instagram.com/aguilda_smd/" target="_blank"class="text-dark mt-2" style="font-size: 1.2em;">Siga nossas redes!</a></p>';
      echo '</div>';
      echo '</footer>';
      echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.js'></script>";
      echo "</body>";
      echo "</html>";
    }
?>           

    

