<?php 
    session_start();

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
        header("location: Usuario_dashboard.php");
        exit;
    }

    require_once "config.php";

    $apelido = $senha = "";
    $apelido_erro = $senha_erro = $login_erro = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["apelido"]))){
            $apelido_erro = "Por favor, insira o apelido.";
        } else {
            $apelido = trim($_POST["apelido"]);
        }

        if(empty(trim($_POST["senha"]))){
            $senha_erro = "Por favor, insira sua senha.";
        } else {
            $senha = trim($_POST["senha"]);
        }

        if(empty($apelido_erro) && empty($senha_erro)){
            $sql = "SELECT id, apelido, senha FROM usuarios WHERE apelido = (?)";

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("s", $param_apelido);

                $param_apelido = trim($_POST["apelido"]);

                if($stmt->execute()){
                    $stmt_res = $stmt->get_result();
                    if($stmt_res->num_rows == 1){
                        if($row = $stmt_res->fetch_assoc()){
                            $id = $row["id"];
                            $apelido = $row["apelido"];
                            $hashed_senha = $row["senha"];

                            if(password_verify($senha, $hashed_senha)){
                                session_start();

                                $_SESSION["loggedIn"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["apelido"] = $apelido;

                                header("location: Usuario_dashboard.php");
                            } else {
                                $login_erro = "Apelido ou senha inválidos";
                            }
                        }
                    } else {
                        $login_erro = "Apelido ou senha inválidos.";
                    }
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
    <title>Login</title>
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
    <h1 class="display-4 p-3">Login</h1>
    <p>Por favor, preencha os campos para fazer o login.</p>

    <?php 
        if(!empty($login_erro)){
            echo '<div>' . $login_erro . '</div>';
        }        
        ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group mx-auto p-2" style="width: 400px;">
            <span class="input-group-text">Apelido</span>
            <input type="text" class="form-control" aria-label="Apelido">
            <span><?php echo $apelido_erro; ?></span>
        </div>
        <div class="input-group mx-auto p-2" style="width: 400px;">
            <span class="input-group-text">Senha</span>
            <input type="password" class="form-control" aria-label="Senha">
            <span><?php echo $senha_erro; ?></span>
        </div>
        <div class="p-4">
            <button class="btn btn-success" style="width: 100px;" type="submit">Entrar</button>
        </div>
        <p>Não tem uma conta? <a href="Cadastro.php">Inscreva-se agora</a>.</p>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>