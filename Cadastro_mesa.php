<?php
session_start();
require_once "config.php";
$nome = $sistema = "";
$nome_erro = $sistema_erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["nome"]))) {
        $nome_erro = "Por favor, dê um nome para a sua campanha.";
    } else {
        // Essa query deveria ser para validar se já existe uma mesa com o nome solicitado?
        // Se sim, tem que refatorar. Além disso, estamos utilizando o objeto mySQLi para fazer
        // a conexão com o banco. Logo refatorar com isso em conta também. Ademais, lembre de 
        // usar a função close() para fechar a conexão com o banco.

        //Trocar para selecionar o id do usuário de acordo com o seu LOGIN
        $sql = "SELECT id from usuario WHERE nome = (?)";

        if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param('s', $parametro_nome);
            $parametro_nome = trim($_POST["nome"]);
            if($stmt->execute()) {
                $stmt_res =  $stmt->get_result();
                if($stmt_res->num_rows == 1) {
                    $nome_erro = "Esse nome de campanha já existe.";
                } else {
                    $nome = trim($_POST["nome"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor tente novamente mais tarde.";
            }
            $stmt->close();
        }
    }
        if(empty(trim($_POST["sistema"]))) {
            $sistema_erro = "Por favor, determine um sistema de jogo para a sua campanha.";
        } else {
            $sistema = trim($_POST["sistema"]);
        }

        if(empty($nome_error) && empty($sistema_error)) {
            $sql = "INSERT INTO mesa (nome_mestre, sistema) VALUES (?, ?)";
            if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $parametro_nome, $parametro_sistema);
            $parametro_nome = $nome;
            $parametro_sistema = $sistema;
            if($stmt->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>location.href='Login.php';</script>";
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            $stmt->close();
    }    
    }
   $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de mesa | A Taverna</title>
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="css\bootstrap.min.css" rel="stylesheet">
    <!-- Folha do multi-select-tag -->
    <link rel="stylesheet" href="css\multi-select-tag.css">
</head>
<body>
    <!-- Barra de navegação -->
  <nav class="navbar bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="Pagina_inicial.php">Taverna</a>
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
              <a class="nav-link" href="Usuario_dashboard.php">Dashboard</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-4">
        <h1 class="display-4 p-3">Criar uma nova mesa</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Nome da campanha</span>
                <input type="text" name="nome_campanha" class="form-control <?php echo (!empty($nome_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                <span class="invalid-feedback"><?php echo $nome_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Sistema</span>
                <input type="text" name="sistema" class="form-control <?php echo (!empty($sistema_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $sistema; ?>">
                <span class="invalid-feedback"><?php echo $sistema_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Bio</span>
                <textarea name="bio" class="form-control"></textarea>
                <span></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Duração</span>
                <select name="duracao" class="form-control">
                    <option></option>
                    <option>One-shot</option>
                    <option>Curta</option>
                    <option>Média</option>
                    <option>Longa</option>
                    <option>Odisseia</option>
                </select>
                <span></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Tema</span>
                <select name="tema" id="theme" multiple>
                  <option>Ação</option>
                  <option>Aventura</option>
                  <option>Horror</option>
                  <option>Mistério</option>
                  <option>Body Building</option>
                </select>
                <span></span>
            </div>
            <div class="p-4">
                <button class="btn btn-success" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="js\bootstrap.bundle.min.js"></script>
    <!-- Script do multi-select-tag -->
    <script src="js\multi-select-tag.js"></script>
    <script>
      new MultiSelectTag('theme')  // id
    </script>
</body>
</html>
