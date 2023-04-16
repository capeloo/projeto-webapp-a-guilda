<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, caso contrário, redirecione para a página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$new_senha= $confirmar_senha = "";
$new_senha_err = $confirmar_senha_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nova senha
    if(empty(trim($_POST["new_senha"]))){
        $new_senha_err = "Por favor insira a nova senha.";     
    } elseif(strlen(trim($_POST["new_senha"])) < 6){
        $new_senha_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $new_senha = trim($_POST["new_senha"]);
    }
    
    // Validar e confirmar a senha
    if(empty(trim($_POST["confirmar_senha"]))){
        $confirmar_senha_err = "Por favor, confirme a senha.";
    } else{
        $confirmar_senha = trim($_POST["confirmar_senha"]);
        if(empty($new_senha_err) && ($new_senha != $confirmar_senha)){
            $confirmar_senha_err = "A senha não confere.";
        }
    }
        
    // Verifique os erros de entrada antes de atualizar o banco de dados
    if(empty($new_senha_err) && empty($confirmar_senha_err)){
        // Prepare uma declaração de atualização
        $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":senha", $param_senha, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            // Definir parâmetros
            $param_senha = password_hash($new_senha, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/media-queries.css">
</head>
<body>
    <main>
        <h1>Redefinir senha</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Nova senha</label> 
                <input type="password" name="new_senha" class="form-control <?php echo (!empty($new_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_senha; ?>">
                <span class="invalid-feedback"><?php echo $new_senha_err; ?></span>

                <label>Confirme a senha</label> 
                <input type="password" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirmar_senha_err; ?></span>
            
                <input type="submit" value="Redefinir" id="btn">
                <a href="home.php">Cancelar</a>
        </form>
    </main>
</body>
</html>