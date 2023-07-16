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
  <link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../css/standard.css" rel="stylesheet">
  <link href="../../../css/ticket_dashboard.css" rel="stylesheet">
</head>
<body class="bg-dark">
<header class="sticky-top" id="h">
    <a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
    <nav>
      <div class='container-fluid'>
      <div>
      <img src="../../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">
      <form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>
      <div style='display:flex;'>
      <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
      </div>
      </form>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../../noticias/Escrever_noticia.php">Escrever notícia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-identificação-não-verificada-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="Lista_denuncia.php">Tickets de denúncia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../perfil/Lista_perfis.php">Lista de perfis</a>
      <hr class="dropdown-divider">
      <a class="dropdown-item" href="../login/logout.php">Sair</a>
      </div>
      </div>
      </div>
      </div>
      </nav>
      </header>
      <main>
  <div class="container-fluid text-center">
    <!-- Conteúdo da página -->
    <h1 class="pt-5 mb-5"><?php echo $row["titulo"]; ?></h1>
    <!-- Formulário -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="container-fluid" style="display: flex;">
        <div class="container-fluid">
          <div class="p-2 mb-3 ms-4" style="width: 250px; border-radius: 0.2em; background-color: #8FBEAE; color: #134F59;">
            <h3>Denunciante: <?php echo $row["apelido_denunciante"]; ?></h3>
          </div>
          <div class="p-2 ms-4" style="width: 250px; border-radius: 0.2em; background-color: #8FBEAE; color: #134F59;">
            <h3>Denunciado: <?php echo $row["apelido_denunciado"]; ?></h3>
          </div>
        </div>
        <div class="container-fluid">
          <div class="p-2" style="width: 350px; border-radius: 0.2em; background-color: #8FBEAE; color: #134F59;">
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
          <div class="text-start p-2 ms-2 me-4" style="width: 500px; border-radius: 0.2em; background-color: #8FBEAE; color: #134F59;">
            <h3 class="ms-2">Comentário:</h3>
            <p class="ms-2" style="font-size: 1.2em;"><?php echo $row["comentario"]; ?></p>
        </div>
      </div>
    </form>
  </div>
  </main>
  <footer>
      <div class="container-fluid">
        <p>&copy; A Guilda. Siga em frente!</p>
        <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>
      </div>
    </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>