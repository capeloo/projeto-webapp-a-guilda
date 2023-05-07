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
</head>
<body>
    <h1>Login</h1>
    <p>Por favor, preencha os campos para fazer o login.</p>

    <?php 
        if(!empty($login_erro)){
            echo '<div>' . $login_erro . '</div>';
        }        
        ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Apelido</label>
            <input type="text" name="apelido">
            <span><?php echo $apelido_erro; ?></span>
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha">
            <span><?php echo $senha_erro; ?></span>
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
        <p>Não tem uma conta? <a href="Cadastro.php">Inscreva-se agora</a>.</p>
    </form>
</body>
</html>