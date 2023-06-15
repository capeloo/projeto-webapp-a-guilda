<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="./../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Barra de navegação -->
  <nav class="navbar bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="../usuario/Usuario_dashboard.php">Taverna</a>
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
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-3 bg-light" style="width: 500px;">
        <h1 class="p-4">Lista de mesas</h1>
    </div>

    <?php 
    //Script da lista de mesas

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

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
    ?>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>