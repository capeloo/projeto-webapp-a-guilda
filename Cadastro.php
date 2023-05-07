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
            $sql = "SELECT id FROM usuarios WHERE apelido = (?)";

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
            $sql = "INSERT INTO usuarios (apelido, senha) VALUES (?, ?)";

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
</head>
<body>
    <h1>Criar conta</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Apelido</label>
            <input type="text" name="apelido">
            <span><?php echo $apelido_erro; ?></span>
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha">
            <span><?php echo $senha_erro ?></span>
        </div>
        <div>
            <label>Confirme a senha</label>
            <input type="password" name="confirmar_senha">
            <span><?php echo $confirmar_senha_erro ?></span>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
            <button type="reset">Apagar dados</button>
        </div>
        <p>
            Já tem uma conta? <a href="Login.php">Entre aqui</a>.
        </p>
    </form>
</body>
</html>