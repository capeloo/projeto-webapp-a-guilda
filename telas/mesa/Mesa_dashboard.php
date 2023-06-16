<?php 
  //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
  session_start();

  //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
  set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
  require_once 'config.php';

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
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mesa dashboard</title>
  <link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">
  <!-- Chamando as folhas de estilo do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Folha do multi-select-tag -->
  <link href="../../css/multi-select-tag.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Barra de navegação -->
  <nav class="navbar bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="../usuario/Usuario_dashboard.php">Taverna</a>
      <form class='form-inline' action='../pesquisar.php' method='post'>
        <div style='display:flex;'>
          <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
          <button class='btn btn-outline-light my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
        </div>
      </form>
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
              <a class="nav-link" href="../usuario/perfil/Perfil.php">Meu perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>
            </li>
            <li class="nav-item" style="margin-top: 10px;">
              <strong>Mesas</strong>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Lista_de_mesas.php">Lista de mesas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Cadastro_mesa.php">Cadastro de mesa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Minhas_mesas.php">Minhas mesas</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container-fluid text-center mt-3">
    <!-- Conteúdo da página -->
    <h1 class="p-3">Mesa</h1>
    <!-- Formulário -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="row">
        <div class="col">
          <!-- Consertar tema e foto -->
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text" style="width: 283px; border-radius: 5px;justify-content:center;">Tema</span>
            <select name="tema" id="theme" multiple>
              <option>Ação</option>
              <option>Aventura</option>
              <option>Horror</option>
              <option>Mistério</option>
              <option>Body Building</option>
            </select>
          </div>
          <div class="input-group mx-auto p-2" style="width: 350px;">
            <span class="input-group-text" style="width: 350px; border-radius: 5px 5px 0px 0px;">Foto</span>  
            <img src="<?php echo $row["foto"]; ?>" alt="foto-perfil" name="foto" class="img" width="335px" height="260px" style="border-radius: 0px 0px 5px 5px;">
          </div>
        </div>  
        <div class="col">
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Duração</span>
            <select name="duracao" class="form-control" disabled>
              <option ><?php echo $row["duracao"]; ?></option>
              <option>One-shot</option>
              <option>Curta</option>
              <option>Média</option>
              <option>Longa</option>
              <option>Odisseia</option>
            </select>
          </div>
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Classificação Indicativa</span>
            <select name="classificacao" class="form-control" disabled>
              <option><?php echo $row["classificacao_indicativa"]; ?></option>
              <option>L</option>
              <option>10</option>
              <option>12</option>
              <option>14</option>
              <option>16</option>
              <option>18</option>
            </select>
          </div>
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Número de vagas</span>
            <input type="number" class="form-control" name="vagas" value="<?php echo $row["numero_vagas"]; ?>" disabled>
          </div>
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Nível dos jogadores</span>
            <select name="nivel" class="form-control" disabled>
              <option><?php echo $row["nivel_jogadores"]; ?></option>
              <option>Livre</option>
              <option>Iniciante</option>
              <option>Intermediário</option>
              <option>Avançado</option>
              <option>Mestre</option>
            </select>
          </div>
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Data</span>
            <input type="date" class="form-control" name="data" value="<?php echo $row["data"]; ?>" disabled>
          </div>
          <div class="input-group mx-auto p-2" style="width: 300px;">
            <span class="input-group-text">Hora</span>
            <input type="time" class="form-control" name="hora" value="<?php echo $row["hora"]; ?>" disabled>
          </div>
        </div>
        <div class="col">
          <div class="input-group mx-auto p-2" style="width:  400px;">
            <span class="input-group-text">Nome da campanha</span>
            <input type="text" name="nome_campanha" class="form-control" value="<?php echo $row["nome_campanha"]; ?>" disabled>
          </div>
          <div class="input-group mx-auto p-2" style="width: 400px;">
            <span class="input-group-text">Sistema</span>
            <input type="text" name="sistema" class="form-control" value="<?php echo $row["sistema"]; ?>" disabled>
          </div>
          <div class="input-group mx-auto p-2" style="width: 400px;">
            <span class="input-group-text">Sinopse</span>
            <textarea name="sinopse" class="form-control" disabled><?php echo $row["sinopse"]; ?></textarea>
          </div>
          <div class="input-group mx-auto p-2" style="width: 400px;">
            <span class="input-group-text">Requisitos</span>
            <textarea name="requisitos" class="form-control" disabled><?php echo $row["requisitos"]; ?></textarea>
          </div>
        </div>
      </div>    
    </form>
    <div>
      <a href="inscrever.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Inscrever-se</a>
    </div> 
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