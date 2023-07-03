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
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

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
            $sql = "SELECT id, admin, apelido, senha FROM usuario WHERE apelido = (?)";

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
                            $admin = $row["admin"];
                    // 7. Verificação da senha
                            if(password_verify($senha, $hashed_senha)){
                                // 8. Inicia a sessão e atribui valores as variáveis da sessão
                                session_start();

                                $_SESSION["loggedIn"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["apelido"] = $apelido;
                                $_SESSION["admin"] = $admin;

                                // 9. Redireciona para o dashboard
                                header("location: ../Usuario_dashboard.php");
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
    <link rel="shortcut icon" href="../../../assets/images/favicon.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/media-queries.css"> 
    <link rel="stylesheet" href="../../../css/index.css">
</head>
<body id="body-login">
<header class="sticky-top" id="header-login">
    <!-- Barra de navegação -->
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../../index.php" id="logo"><div>A Taverna</div></a>
        <div>
          <a href="Cadastro.php" id="button-cadastrar"><div>Criar conta</div></a>
          <a href="Login.php" id="button-entrar-login"><div>Entrar</div></a>
        </div>
      </div>
    </nav> 
  </header>
    <!-- Conteúdo da página -->
    <main id="main-login" class="container-fluid text-center" style="display: flex; background: url(../../../assets/images/tela\ login.png); background-size: cover; background-position: right; background-repeat: no-repeat;">
    <div id="login">
        <h1 class="p-3" id="titulo-login">Faça seu login</h1>
        <?php 
            if(!empty($login_erro)){
                echo '<div class="text-danger">' . $login_erro . '</div>';
            }        
        ?>
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
            <div class="mt-2">
                <button id="entrar-login" type="submit">Entrar</button>
            </div>
            <p>Não tem uma conta? <a href="Cadastro.php">Inscreva-se agora</a>.</p>
            <a href="Esqueceu_senha.php">Esqueceu a senha?</a>
        </form>
        </div>
        <div style="width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-left:5em solid #134F59; margin-top: 12em;"></div>
        <div style="background-image: url(../../../assets/images/olhos.svg); background-size: contain; background-repeat: no-repeat; width: 5.2em; margin-left: 16.5em; margin-top: 12.4em;"></div>
        
    </div>
        </main>
        <footer id="footer-login">
    <div class="container-fluid">
      <p>&copy; A Guilda. Siga em frente!</p>
      <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon.png"></a></p>
    </div>
  </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>