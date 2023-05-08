<?php 
    require_once "config.php";

    $apelido = $senha = $confirmar_senha = "";
    $apelido_erro = $senha_erro = $confirmar_senha_erro = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["apelido"]))){
            $apelido_erro = "Por favor coloque um apelido.";
        } else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["apelido"]))){
            $apelido_erro = "O apelido pode conter apenas letras, números e sublinhados.";
        } else {
            $sql = "SELECT id FROM usuario WHERE apelido = (?)";

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param('s', $param_apelido);

                $param_apelido = trim($_POST["apelido"]);

                if($stmt->execute()){
                    $stmt_res = $stmt->get_result();
                    if($stmt_res->num_rows == 1){
                        $apelido_erro = "Este apelido já está em uso.";
                    } else {
                        $apelido = trim($_POST["apelido"]);
                    }
                } else {
                    echo "Ops! Algo deu errado. Por favor tente novamente mais tarde.";
                }
                $stmt->close();
            }
        }

        if(empty(trim($_POST["senha"]))){
            $senha_erro = "Por favor insira uma senha.";
        } else if(strlen(trim($_POST["senha"])) < 6){
            $senha_erro = "A senha deve ter pelo menos 6 caracteres.";
        } else {
            $senha = trim($_POST["senha"]);
        }

        if(empty(trim($_POST["confirmar_senha"]))){
            $confirmar_senha_erro = "Por favor, confirme a senha.";
        } else {
            $confirmar_senha = trim($_POST["confirmar_senha"]);

            if(empty($senha_erro) && ($senha != $confirmar_senha)){
                $confirmar_senha_erro = "A senha não confere.";
            }
        }

        if(empty($apelido_erro) && empty($senha_erro) && empty($confirmar_senha_erro)){
            $sql = "INSERT INTO usuario (apelido, senha) VALUES (?, ?)";

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("ss", $param_apelido, $param_senha);

                $param_apelido = $apelido;
                $param_senha = password_hash($senha, PASSWORD_DEFAULT);

                if($stmt->execute()){
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
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="Pagina_inicial.php">Página Inicial</a>
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
            <a class="nav-link" href="Login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Cadastro.php">Criar conta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Pagina_inicial.php">Página inicial</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
    <div class="container-fluid text-center mt-4">
        <h1 class="display-4 p-3">Criar conta</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Apelido</span>
                <input type="text" name="apelido" class="form-control <?php echo (!empty($apelido_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $apelido; ?>">
                <span class="invalid-feedback"><?php echo $apelido_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Senha</span>
                <input type="password" name="senha" class="form-control <?php echo (!empty($senha_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                <span class="invalid-feedback"><?php echo $senha_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Confirmar senha</span>
                <input type="password" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmar_senha; ?>">
                <span class="invalid-feedback"><?php echo $confirmar_senha_erro; ?></span>
            </div>
            <div class="p-4">
                <button class="btn btn-success" type="submit">Cadastrar</button>
                <button class="btn btn-danger" type="reset">Apagar dados</button>
            </div>
            <p>
                Já tem uma conta? <a href="Login.php">Entre aqui</a>.
            </p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>