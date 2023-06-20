<?php
//Script das minhas mesas

      //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
      session_start();

      //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
      set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
      require_once 'config.php';
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets de Denúncia</title>
    <link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <!-- Barra de navegação -->
    <nav class='navbar bg-light sticky-top'>
      <div class='container-fluid'>
      <a class='navbar-brand text-dark' href='../Usuario_dashboard.php'>Taverna</a>
      <form class='form-inline' action='../../pesquisar.php' method='post'>
      <div style='display:flex;'>
      <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
      <button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
      </div>
      </form>
      <button class='navbar-toggler bg-light' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
      </button>
      <div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasNavbar' aria-labelledby='offcanvasNavbarLabel'>
      <div class='offcanvas-header'>
      <h5 class='offcanvas-title' id='offcanvasNavbarLabel'>Menu</h5>
      <button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>
      </div>
      <div class='offcanvas-body'>
      <ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>
      <li class='nav-item'>
      <strong>Perfil</strong>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='../perfil/Lista_perfis.php'>Lista de perfis</a>
      </li>
      <li class='nav-item' style='margin-top: 10px;'>
      <li class='nav-item'>
      <strong>Mesa</strong>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='../../mesa/Lista_de_mesas.php'>Lista de mesas</a>
      </li>
      <li class='nav-item' style='margin-top: 10px;'>
      <strong>Denúncia</strong>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='Lista_denuncia.php'>Tickets de Denúncia</a>
      </li>
      <li class='nav-item'>
      <li class='nav-item' style='margin-top: 10px;'>
      <strong>Notícias</strong>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='../noticias/Escrever_noticia.php'>Escrever Notícia</a>
      </li>
      </ul>
      </div>
      </div>
      </div>
      </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-4 bg-dark" style="width: 450px;">
      <h1 class="p-2 text-light">Tickets de Denúncia</h1>
    </div>
    <div class="container-fluid text-start mt-4 bg-dark" style="margin:auto;">
        <?php
          $id = $_SESSION["id"];

          //Prepara a requisição ao banco
          $sql = "SELECT * 
                  FROM denuncia";

          $stmt = $mysqli->query($sql);

          $qtd = $stmt->num_rows;

          //Renderiza os dados na forma de tabela
          if($qtd > 0){
            echo "<table class='table table-hover table-striped table-bordered bg-light mb-5' style='width: 1100px; margin: auto;'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Título</th>";
            echo "<th>Denunciante</th>";
            echo "<th>Denunciado</th>";
            echo "<th>Motivo</th>";
            echo "<th colspan='2'>Ações</th>";
            echo "</tr>";
          while($row = $stmt->fetch_object()){
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->titulo . "</td>";
            echo "<td>" . $row->apelido_denunciante . "</td>";
            echo "<td>" . $row->apelido_denunciado . "</td>";
            echo "<td>" . $row->motivo . "</td>";
            echo "<td>
                    <button class='btn btn-success' onclick=\"location.href='Ticket_dashboard.php?id=".$row->id."';\">Acesse</button>
                  </td>";        
            echo "</tr>";
          }
        echo "</table>";
        } else {
          echo "<p class='alert-danger'>Não encontrou resultados!</p>";
        }
        ?>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>