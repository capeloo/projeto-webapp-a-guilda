<?php 
    // Incluir arquivo de configuração
    require_once "config.php";

    // Defina variáveis e inicialize com valores vazios
    $login = $senha = $confirmar_senha = "";
    $login_err = $senha_err = $confirmar_senha_err = "";

    // Processando dados do formulário quando o formulário é enviado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validar nome de usuário
        if(empty(trim($_POST["login"]))){
            $login_err = "<p style='color:red; padding:5px;'>Por favor coloque um nome de usuário.</p>";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["login"]))){
            $login_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
        } else {
            // Prepare uma declaração selecionada
            $sql = "SELECT id FROM usuarios WHERE login = :login";

            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":login", $param_login, PDO::PARAM_STR);

                // Definir parâmetros
                $param_login = trim($_POST["login"]);

                // Tente executar a declaração preparada
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $login_err = "Este nome de usuário já está em uso.";
                    } else {
                        $login = trim($_POST["login"]);
                    }
                } else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }

            // Fechar declaração
            unset($stmt);
            }
        }

        // Validar senha
        if(empty(trim($_POST["senha"]))){
            $senha_err = "<p style='color:red; padding:5px;'>Por favor insira uma senha.</p>";
        } elseif(strlen(trim($_POST["senha"])) < 6){
            $senha_err = "A senha deve ter pelo menos 6 caracteres.";
        } else {
            $senha = trim($_POST["senha"]);
        }

        // Validar e confirmar a senha
        if(empty(trim($_POST["confirmar_senha"]))){
            $confirmar_senha_err = "Por favor, confirma a senha.";
        } else {
            $confirmar_senha = trim($_POST["confirmar_senha"]);
            if(empty($senha_err) && ($senha != $confirmar_senha)){
                $confirmar_senha_err = "A senha não confere.";
            }
        }

        // Verifique os erros de entrada antes de inserir no banco de dados
        if(empty($login_err) && empty($senha_err) && empty($confirmar_senha_err)){

            // Prepare uma declaração de inserção
            $sql = "INSERT INTO usuarios (login, senha) VALUES (:login, :senha)";

            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":login", $param_login, PDO::PARAM_STR);
                $stmt->bindParam(":senha", $param_senha, PDO::PARAM_STR);

                // Definir parâmetros
                $param_login = $login;
                $param_senha = password_hash($senha, PASSWORD_DEFAULT); // Creates a password hash

                // Tente executar a declaração preparada
                if($stmt->execute()){
                    // Redirecionar para a página de login
                    header("location: login.php");
                } else{
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }

                // Fechar declaração
                unset($stmt);
            }
        }
        // Fechar conexão
        unset($pdo);           
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/media-queries.css">
</head>
<body>
    <main>
        <h1>Cadastre-se aqui</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form">
                <label>Login</label> 
                <input type="text" name="login" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login; ?>"> 
                <span class="invalid-feedback"><?php echo $login_err; ?></span>

                <label>Senha</label> 
                <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                <span class="invalid-feedback"><?php echo $senha_err; ?></span> 

                <label>Confirme a senha</label> 
                <input type="password" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmar_senha; ?>"> 
            
                <input type="submit" value="Criar conta" id="btn">

                <p>
                    Já tem uma conta? 
                    <a href="login.php">Entre aqui</a>.
                </p>
        </form>
    </main>
</body>
</html>