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
    <link rel="shortcut icon" href="../../../assets/images/favicon.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/media-queries.css"> 
    <link rel="stylesheet" href="../../../css/custom.css">
</head>
<body style="overflow-x: hidden;">
<header class="sticky-top" id="header-cadastro">
    <!-- Barra de navegação -->
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../../index.php" id="logo"><div>A Taverna</div></a>
        <div>
          <a href="Cadastro.php" id="button-cadastrar"><div>Criar conta</div></a>
          <a href="Login.php" id="button-entrar"><div>Entrar</div></a>
        </div>
      </div>
    </nav> 
  </header>
    <!-- Conteúdo da página -->
    <main id="main-cadastro" style="display: flex; background: url(../../../assets/images/tela\ login.png); background-size: cover; background-position: right; background-repeat: no-repeat;">
    <div class="container-fluid text-center" id="cadastro">
        <h1 class="p-3" id="titulo-cadastro">Primeira vez aqui?</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mx-auto p-2" style="width: 300px;">
                <input type="text" name="apelido" class="form-control <?php echo (!empty($apelido_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $apelido; ?>" placeholder="Apelido" style="border-radius: 0.2em;">
                <span class="invalid-feedback"><?php echo $apelido_erro; ?></span>
            </div>
            <div class="mx-auto p-2" style="width: 300px;">
                <input type="password" name="senha" class="form-control <?php echo (!empty($senha_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>" placeholder="Senha" style="border-radius: 0.2em;">
                <span class="invalid-feedback"><?php echo $senha_erro; ?></span>
            </div>
            <div class="mx-auto p-2" style="width: 300px;">
                <input type="password" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmar_senha; ?>" placeholder="Confirmar senha" style="border-radius: 0.2em;">
                <span class="invalid-feedback"><?php echo $confirmar_senha_erro; ?></span>
            </div>
            <div class="mt-2">
                <button id="cadastrar-cadastro" type="submit">Cadastrar</button>
            </div>
            <p>
                Já tem uma conta? <a href="Login.php">Entre aqui</a>.
            </p>
        </form>
        </div>
    <div style="width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-left:5em solid #134F59; margin-top: 12em;">
    </div>
    <div style="background-image: url(../../../assets/images/olhos.svg); background-size: contain; background-repeat: no-repeat; width: 5.2em; margin-left: 16.5em; margin-top: 12.4em;"></div>
</main>
<footer id="footer-cadastro">
    <div class="container-fluid">
      <p>&copy; A Guilda. Siga em frente!</p>
      <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon.png"></a></p>
    </div>
  </footer>
    
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>