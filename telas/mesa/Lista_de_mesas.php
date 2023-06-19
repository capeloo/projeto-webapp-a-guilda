<?php 
    //Script da lista de mesas

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
      echo '<!DOCTYPE html>';
      echo '<html lang="pt-br">';
      echo '<head>';
      echo '<meta charset="UTF-8">';
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
      echo '<title>Dashboard</title>';
      echo '<link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">';
      echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
      echo '</head>';
      echo '<body class="bg-light">';
      echo '<nav class="navbar bg-dark sticky-top">';
      echo '<div class="container-fluid">';
      echo '<a class="navbar-brand text-light" href="../usuario/Usuario_dashboard.php">Taverna</a>';
      echo "<form class='form-inline' action='../pesquisar.php' method='post'>";
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
      echo '<a class="nav-link" href="../usuario/perfil/Perfil.php">Meu perfil</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>';
      echo '</li>';
      echo '<li class="nav-item" style="margin-top: 10px;">';
      echo '<strong>Mesas</strong>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="Lista_de_mesas.php">Lista de mesas</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="Cadastro_mesa.php">Cadastro de mesa</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="Minhas_mesas.php">Minhas mesas</a>';
      echo '</li>';
      echo '</ul>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</nav>';
      echo '<div class="container-fluid text-center mt-3 bg-light" style="width: 500px;">';
      echo '<h1 class="p-4">Lista de mesas</h1>';
      echo '</div>';

    //Prepara a requisição ao banco
    $sql = "SELECT * FROM mesa";

    $stmt = $mysqli->query($sql);

    $qtd = $stmt->num_rows;

    //Renderiza os dados na forma de tabela
    if($qtd > 0){
        echo "<table class='table table-hover table-striped table-bordered' style='width:1230px; margin:auto;'>";
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
                    <button class='btn btn-success' onclick=\"location.href='Mesa_dashboard.php?id=".$row->id."';\">Acesse</button>
                  </td>";        
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='alert-danger'>Não encontrou resultados!</p>";
    }
  
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
    echo '</body>';
    echo '</html>';

    } else if($_SESSION["admin"] == 1){
      echo '<!DOCTYPE html>';
      echo '<html lang="pt-br">';
      echo '<head>';
      echo '<meta charset="UTF-8">';
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
      echo '<title>Dashboard</title>';
      echo '<link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">';
      echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
      echo '</head>';
      echo '<body class="bg-dark">';
      echo "<nav class='navbar bg-light sticky-top'>";
      echo "<div class='container-fluid'>";
      echo "<a class='navbar-brand text-dark' href='../usuario/Usuario_dashboard.php'>Taverna</a>";
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
      echo "<a class='nav-link' href='../usuario/perfil/Lista_perfis.php'>Lista de perfis</a>";
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
      echo "<a class='nav-link' href='../usuario/denuncia/Lista_denuncia.php'>Tickets de Denúncia</a>";
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
      echo '<div class="container-fluid text-center mt-3 bg-dark" style="width: 500px;">';
      echo '<h1 class="p-4 text-light">Lista de mesas</h1>';
      echo '</div>';

    //Prepara a requisição ao banco
    $sql = "SELECT * FROM mesa";

    $stmt = $mysqli->query($sql);

    $qtd = $stmt->num_rows;

    //Renderiza os dados na forma de tabela
    if($qtd > 0){
        echo "<table class='table table-hover table-striped table-bordered bg-light' style='width:1230px; margin:auto;'>";
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
                    <button class='btn btn-success' onclick=\"location.href='Mesa_dashboard.php?id=".$row->id."';\">Acesse</button>
                  </td>";        
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='alert-danger'>Não encontrou resultados!</p>";
    }
  
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
    echo '</body>';
    echo '</html>';
    }
?>

