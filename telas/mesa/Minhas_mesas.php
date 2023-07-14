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
    <title>Minhas mesas</title>
    <link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/standard.css" rel="stylesheet">
    <link href="../../css/minhas_mesas.css" rel="stylesheet">
</head>
<body>
<header class="sticky-top" id="h">
  <a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
  <nav>
    <div class='container-fluid'>
      <div>
        <form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>
          <div style='display:flex;'>
            <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
          </div>
        </form>
        <div class="dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Lista_de_mesas.php">Lista de mesas</a>
            <a class="dropdown-item" href="Minhas_mesas.php">Minhas mesas</a>
            <a class="dropdown-item" href="Cadastro_mesa.php">Cadastrar mesa</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>
          <div class="dropdown-menu dropdown-menu-lg-end">
            <a class="dropdown-item" href="../noticias/Lista_de_noticias.php">Feed de notícias</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>
          <div class="dropdown-menu dropdown-menu-lg-end">
            <a class="dropdown-item" href="../usuario/perfil/Perfil.php">Meu perfil</a>
            <a class="dropdown-item" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
<main style="background-image: url(../../assets/images/minhas-mesas-fundooo.png); background-size: cover; background-repeat: no-repeat; background-position: top center;">
    <!-- Conteúdo da página -->
    <div class="row container-fluid text-center" style="margin:auto;">
      <div class="col">
        <h1 class="p-2 text-center mb-4">Mestrando</h1>
        <?php
          $id = $_SESSION["id"];

          //Prepara a requisição ao banco
          $sql = "SELECT * 
                  FROM mesa
                  WHERE id_mestre = $id
                  LIMIT 6";

          $stmt = $mysqli->query($sql);

          $qtd = $stmt->num_rows;

          //Renderiza os dados na forma de tabela
          if($qtd > 0){
            echo "<table class='table table-hover table-striped table-bordered' style='width:800px; margin:auto;'>";
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
                    <button class='btn' style='background-color: #134F59; color: white;' onclick=\"location.href='Mesa_dashboard.php?id=".$row->id."';\">+</button>
                  </td>";        
            echo "</tr>";
          }
        echo "</table>";
        } else {
          echo "<h3 class='text-danger'>Você ainda não está inscrito em nenhuma mesa!</h3>";
        }
        ?>
      </div>
      <div class="col" style="height: 50em; margin-top: 4em;">
        <h1 class="p-2 text-center mt-4 mb-4">Participando</h1>
        <?php
        
          $sql = "SELECT mesas
                  FROM usuario
                  WHERE id = $id
                  LIMIT 6
                  ";

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
                      IN ('$mesas_str')";
                  
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
              echo "<table class='table table-hover table-striped table-bordered' style='width:800px; margin:auto;'>";
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
                      <button class='btn' style='background-color: #134F59; color: white;' onclick=\"location.href='Mesa_dashboard.php?id=".$row->id."';\">+</button>
                    </td>";        
              echo "</tr>";
            }
              echo "</table>";
          }      
          } else {
            echo "<h3 class='text-danger'>Você ainda não está inscrito em nenhuma mesa!</h3>";
          }   
        ?>
      </div>
    </div>
</main>
<footer>
  <div class="container-fluid">
    <p>&copy; A Guilda. Siga em frente!</p>
    <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>
  </div>
</footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>