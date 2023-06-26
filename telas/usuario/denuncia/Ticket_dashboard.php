<?php 
  //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
  session_start();

  //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
  set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
  require_once 'config.php';

  $sql = "SELECT *
          FROM denuncia
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

  $str = explode(";", $row["motivo"]);
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket dashboard</title>
  <link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">
  <!-- Chamando as folhas de estilo do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Folha do multi-select-tag -->
  <link href="../../css/multi-select-tag.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <!-- Barra de navegação -->
  <nav class="navbar bg-light sticky-top">
    <div class="container-fluid">
    <a class="navbar-brand text-dark" href="../Usuario_dashboard.php">Taverna</a>
    <form class='form-inline' action='../../pesquisar.php' method='post'>
      <div style='display:flex;'>
        <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
        <button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
      </div>
    </form>
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
    <a class="nav-link" href="../perfil/Lista_perfis.php">Lista de perfis</a>
    </li>
    <li class="nav-item" style="margin-top: 10px;">
    <li class='nav-item'>
    <strong>Mesa</strong>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='../../mesa/Lista_de_mesas.php'>Lista de mesas</a>
    </li>
    <li class='nav-item' style='margin-top: 10px;'>
    <strong>Denúncia</strong>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="Lista_denuncia.php">Tickets de denúncia</a>
    </li>
    <li class="nav-item" style="margin-top: 10px;">
    <li class="nav-item">
    <strong>Notícias</strong>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Escrever notícia</a>
    </li>
    </ul>
    </div>
    </div>
    </div>
    </nav>
  <div class="container-fluid text-center mt-3">
    <!-- Conteúdo da página -->
    <h1 class="p-3 mb-5 text-light"><?php echo $row["titulo"]; ?></h1>
    <!-- Formulário -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="container-fluid" style="display: flex;">
        <div class="container-fluid">
          <div class="bg-success p-2 mb-3 ms-4" style="width: 250px; border-radius: 5px;">
            <h3 class="text-light">Denunciante: <?php echo $row["apelido_denunciante"]; ?></h3>
          </div>
          <div class="bg-danger p-2 ms-4" style="width: 250px; border-radius: 5px;">
            <h3 class="text-light">Denunciado: <?php echo $row["apelido_denunciado"]; ?></h3>
          </div>
        </div>
        <div class="container-fluid">
          <div class="bg-light p-2" style="width: 350px; border-radius: 5px;">
            <div>
              <h3 class="text-start ms-2">Motivo:</h3>
              <?php 
                for ($i=0; $i < count($str); $i++) { 
                  echo "<h4 class='text-start ms-2 mb-3'> ● ".$str[$i]."</h4>";
                } 
              ?>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="bg-light text-start p-2 ms-2 me-4" style="width: 500px; border-radius: 5px;">
            <h3 class="ms-2">Comentário:</h3>
            <p class="ms-2" style="font-size: 1.2em;"><?php echo $row["comentario"]; ?></p>
        </div>
      </div>
    </form>
  </div>
  <!-- Chamando os scripts do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script do multi-select-tag -->
  <script src="../../js/multi-select-tag.js"></script>
  <script>
    new MultiSelectTag('theme')  // id
  </script>
</body>
</html>