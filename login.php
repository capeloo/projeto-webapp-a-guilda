<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$login = $senha = "";
$login_err = $senha_err = $logar_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verifique se o nome de usuário está vazio
    if(empty(trim($_POST["login"]))){
        $login_err = "Por favor, insira o nome de usuário.";
    } else{
        $login = trim($_POST["login"]);
    }
    
    // Verifique se a senha está vazia
    if(empty(trim($_POST["senha"]))){
        $senha_err = "Por favor, insira sua senha.";
    } else{
        $senha = trim($_POST["senha"]);
    }
    
    // Validar credenciais
    if(empty($login_err) && empty($senha_err)){
        // Prepare uma declaração selecionada
        $sql = "SELECT id, login, senha FROM usuarios WHERE login = :login";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":login", $param_login, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_login = trim($_POST["login"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $login = $row["login"];
                        $hashed_password = $row["senha"];
                        if(password_verify($senha, $hashed_password)){
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["login"] = $login;                            
                            
                            // Redirecionar o usuário para a página de boas-vindas
                            header("location: home.php");
                        } else{
                            // A senha não é válida, exibe uma mensagem de erro genérica
                            $logar_err = "Nome de usuário ou senha inválidos.";
                        }
                    }
                } else{
                    // O nome de usuário não existe, exibe uma mensagem de erro genérica
                    $logar_err = "Nome de usuário ou senha inválidos.";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/media-queries.css">
</head>
<body>
    <main>
        <h1>Login</h1>

        <?php 
        if(!empty($logar_err)){
            echo '<div class="alert alert-danger">' . $logar_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Nome do usuário</label> 
                <input type="text" name="login" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login; ?>">
                <span class="invalid-feedback"><?php echo $login_err; ?></span>

                <label>Senha</label> 
                <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $senha_err; ?></span>
            
                <input type="submit" value="Entrar" id="btn">

                <p>
                    Não tem uma conta? <a href="cadastro.php">Inscreva-se agora</a>.
                </p>
        </form>
    </main>
</body>
</html>