<?php 
    session_start();

    require_once "config.php";

    $email = $email_erro = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["email"]))){
            $email_erro = "Por favor coloque um e-mail válido.";
        } else {
            $email = trim($_POST['email']);
        }

        if(empty($email_erro)){
            $sql = "SELECT id, email 
                    FROM usuario 
                    WHERE email = (?)
                    LIMIT 1";

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("s", $param_email);
                $param_email = trim($_POST["email"]);

                if($stmt->execute()){
                    $stmt_res = $stmt->get_result();

                    if($stmt_res->num_rows == 1){
                        $row = $stmt_res->fetch_assoc();
                        $chave = password_hash($row['id'], PASSWORD_DEFAULT);
                        
                        $sql = "UPDATE usuario 
                                SET recuperar_senha = (?) 
                                WHERE id = (?) 
                                LIMIT 1";

                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("si", $chave, $row['id']);
                            
                            if($stmt->execute()){
                                echo "http://localhost/projeto-webapp-taverna/Redefinir_senha.php?key=$chave";
                            }

                        }
                    } else {
                        $email_erro = "E-mail inválido.";
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

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
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
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-4">
        <h1 class="display-4 p-3">Encontre sua conta</h1>
        <p>Por favor, preencha o campo para receber um link de redefinição de senha por e-mail.</p>
        
        <?php 
            if(!empty($_SESSION['msg'])){
                echo '<div class="text-danger">' . $_SESSION['msg'] . '</div>';
            }        
        ?>

        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">E-mail</span>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_erro; ?></span>
            </div>
            <div class="p-4">
                <button class="btn btn-success" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>