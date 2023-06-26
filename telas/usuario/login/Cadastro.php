<?php 
    //Script do cadastro

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    //Inicializa variáveis vazias
    $apelido = $senha = $confirmar_senha = "";
    $apelido_erro = $senha_erro = $confirmar_senha_erro = "";

    //Ao receber os dados do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // 1. Validação do apelido
        // 1.1 Caso o usuário não coloque um apelido
        if(empty(trim($_POST["apelido"]))){
            $apelido_erro = "Por favor coloque um apelido.";
        // 1.2 Caso o usuário coloque um caractere inválido
        } else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["apelido"]))){
            $apelido_erro = "O apelido pode conter apenas letras, números e sublinhados.";
        
        // 1.3 caso já exista um registro no banco do apelido 
        // 1.3.1 Requisição ao banco de dados
        } else {
            // 1.3.2 Guarda a requisição em uma variável
            $sql = "SELECT id FROM usuario WHERE apelido = (?)";

            // 1.3.3 Prepara a requisição
            if($stmt = $mysqli->prepare($sql)){
                // 1.3.3.1 Valida o input do usuário (Evita injeção de código sql no banco) 
                $stmt->bind_param('s', $param_apelido);
                $param_apelido = trim($_POST["apelido"]);
            
            // 1.3.4 Executa a requisição
                if($stmt->execute()){
                    // 1.3.5 Guarda os resultados
                    $stmt_res = $stmt->get_result();

                    // 1.3.6 Validação caso já exista um registro no banco do apelido 
                    if($stmt_res->num_rows == 1){
                        $apelido_erro = "Este apelido já está em uso.";
                    
                    // Passado as validações, atribui o apelido
                    } else {
                        $apelido = trim($_POST["apelido"]);
                    }
                
                // Caso a requisição ao banco tenha dado erro
                } else {
                    echo "Ops! Algo deu errado. Por favor tente novamente mais tarde.";
                }

                // 1.3.7 Fecha a conexão com o banco
                $stmt->close();
            }
        }

        // 1. Validação da senha
        // 1.1 Caso o usuário não coloque uma senha
        if(empty(trim($_POST["senha"]))){
            $senha_erro = "Por favor insira uma senha.";
        
        // 1.2 Definição do tamanho mínimo da senha
        } else if(strlen(trim($_POST["senha"])) < 6){
            $senha_erro = "A senha deve ter pelo menos 6 caracteres.";
        
        // Passado as validações, atribui a senha
        } else {
            $senha = trim($_POST["senha"]);
        }

        // 1. Validação da confirmação da senha
        // 1.1 Caso o usuário não coloque a confirmação da senha
        if(empty(trim($_POST["confirmar_senha"]))){
            $confirmar_senha_erro = "Por favor, confirme a senha.";
        // atribui a confirmação da senha
        } else {
            $confirmar_senha = trim($_POST["confirmar_senha"]);
        // 1.2 Caso as senhas não sejam iguais 
            if(empty($senha_erro) && ($senha != $confirmar_senha)){
                $confirmar_senha_erro = "A senha não confere.";
            }
        }

        // Após o tratamento e a atribuição dos valores em variáveis
        // Caso não tenha dado erro algum, inicia a requisição ao banco
        if(empty($apelido_erro) && empty($senha_erro) && empty($confirmar_senha_erro)){
            // 1. Guarda a requisição em uma variável
            $sql = "INSERT INTO usuario (apelido, senha) VALUES (?, ?)";

            // 2. Prepara a requisição
            if($stmt = $mysqli->prepare($sql)){
                // 2.1 Valida o input do usuário (Evita injeção de código sql no banco) 
                $stmt->bind_param("ss", $param_apelido, $param_senha);
                $param_apelido = $apelido;
                // 2.2 Criptografia da senha
                $param_senha = password_hash($senha, PASSWORD_DEFAULT);
            
            // 3. Executa a requisição
                if($stmt->execute()){
                    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                    echo "<script>location.href='Login.php';</script>";
                } else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }
            
            // 4. Fecha a conexão com o banco
                $stmt->close();
            }
        }

        // 5. Fecha a conexão com o banco (de novo)
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
    <title>Cadastro</title>
    <link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="../../../index.php">Taverna</a>
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-3">
        <h1 class="p-3">Criar conta</h1>
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
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>