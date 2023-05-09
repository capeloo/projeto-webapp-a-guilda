<?php 
    //Script do login

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Valida se o usuário já está logado e o direciona para o dashboard
    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
        header("location: Usuario_dashboard.php");
        exit;
    }

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    require_once "config.php";

    //Inicializa variáveis vazias
    $apelido = $senha = "";
    $apelido_erro = $senha_erro = $login_erro = "";

    //Ao receber os dados do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // 1. Validação do apelido
        // 1.1 Caso o usuário não coloque um apelido 
        if(empty(trim($_POST["apelido"]))){
            $apelido_erro = "Por favor, insira o apelido.";
        
        // Passado as validações, atribui o apelido
        } else {
            $apelido = trim($_POST["apelido"]);
        }

        // 2. Validação da senha
        // 2.1 Caso o usuário não coloque uma senha
        if(empty(trim($_POST["senha"]))){
            $senha_erro = "Por favor, insira sua senha.";

        // Passado as validações, atribui a senha
        } else {
            $senha = trim($_POST["senha"]);
        }

        // Após o tratamento e a atribuição dos valores em variáveis
        // Caso não tenha dado erro algum, inicia a requisição ao banco
        if(empty($apelido_erro) && empty($senha_erro)){
            // 1. Guarda a requisição em uma variável
            $sql = "SELECT id, apelido, senha FROM usuario WHERE apelido = (?)";

            // 2. Prepara a requisição
            if($stmt = $mysqli->prepare($sql)){
                // 2.1 Valida o input do usuário (Evita injeção de código sql no banco)
                $stmt->bind_param("s", $param_apelido);
                $param_apelido = trim($_POST["apelido"]);

            // 3. Executa a requisição
                if($stmt->execute()){
                    // 4. Guarda os resultados
                    $stmt_res = $stmt->get_result();
                    // 5. Se existir apenas um registro na tabela no banco, prossiga
                    if($stmt_res->num_rows == 1){
                    // 6. Traz os valores e atribui eles a variáveis
                        if($row = $stmt_res->fetch_assoc()){
                            $id = $row["id"];
                            $apelido = $row["apelido"];
                            $hashed_senha = $row["senha"];
                    // 7. Verificação da senha
                            if(password_verify($senha, $hashed_senha)){
                                // 8. Inicia a sessão e atribui valores as variáveis da sessão
                                session_start();

                                $_SESSION["loggedIn"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["apelido"] = $apelido;

                                // 9. Redireciona para o dashboard
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
                // 10. Fecha a conexão com o banco
                $stmt->close();
            }
        }
        // 11. Fecha a conexão com o banco (de novo)
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
    <title>Login</title>
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="Pagina_inicial.php">Página Inicial</a>
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
        <h1 class="display-4 p-3">Login</h1>
        <p>Por favor, preencha os campos para fazer o login.</p>

        <?php 
            if(!empty($login_erro)){
                echo '<div class="text-danger">' . $login_erro . '</div>';
            }        
        ?>
        <!-- Formulário -->
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
            <div class="p-4">
                <button class="btn btn-success" style="width: 100px;" type="submit">Entrar</button>
            </div>
            <p>Não tem uma conta? <a href="Cadastro.php">Inscreva-se agora</a>.</p>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>