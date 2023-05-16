<?php 
    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Validação para impedir que o usuário que não logou entre no Editar_perfil
    if(empty($_SESSION)){
        echo "<script>location.href='Login.php';</script>";
    }

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    require_once "config.php";

    //Inicializa variáveis vazias
    $foto = $nome = $bio = $email = $celular = $discord = $matricula = "";
    $foto_erro = $nome_erro = $bio_erro = $email_erro = $celular_erro = $discord_erro = $matricula_erro = "";

    $sql = "SELECT foto, nome, bio, email, celular, discord, matricula
            FROM usuario
            WHERE id = (?)
            LIMIT 1";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        $param_id = $_SESSION["id"];

        if($stmt->execute()){
            $stmt_res = $stmt->get_result();

            if($stmt_res->num_rows == 1){
                $row = $stmt_res->fetch_assoc();
            } else {
                echo "Ops! Algo deu errado (0)";
            }
        } else {
            echo "Ops! Algo deu errado. (1)";
        }
        // Fecha a conexão com o banco
        $stmt->close();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //A fazer:
        //  Validar inputs.
        $foto = trim($_POST["foto"]);
        $nome = trim($_POST["nome"]);
        $bio = trim($_POST["bio"]);
        $email = trim($_POST["email"]);
        $celular = trim($_POST["celular"]);
        $discord = trim($_POST["discord"]);
        $matricula = trim($_POST["matricula"]);

        $sql = "UPDATE usuario
                SET foto = (?), 
                    nome = (?), 
                    bio = (?), 
                    email = (?), 
                    celular = (?), 
                    discord = (?), 
                    matricula = (?)
                WHERE id = (?)
                LIMIT 1";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("bsssssii", $param_foto, $param_nome, $param_bio, $param_email, $param_celular, $param_discord, $param_matricula, $param_id);
            $param_foto = $foto;
            $param_nome = $nome;
            $param_bio = $bio;
            $param_email = $email;
            $param_celular = $celular;
            $param_discord = $discord;
            $param_matricula = $matricula;
            $param_id = $_SESSION["id"];

            if($stmt->execute()){
                echo "<script>alert('Edição realizada com sucesso!');</script>";
                echo "<script>location.href='Usuario_dashboard.php';</script>";
            } else {
                echo "Ops! Algo deu errado. (2)";
            }
            // Fecha a conexão com o banco
            $stmt->close();
        }
        // Fecha a conexão com o banco (de novo)
        $mysqli->close();
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
</head>
<body>
    <h1>Editar perfil</h1>
    <form action="" method="post">
        <div>
            <span>Foto</span>  
            <input type="file" name="foto">
            <span></span>
        </div>
        <div>
            <span>Nome Completo</span>
            <input type="text" name="nome" value="<?php echo $row["nome"]; ?>">
            <span></span>
        </div>
        <div>
            <span>Bio</span>
            <textarea name="bio" cols="30" rows="10" placeholder="<?php echo $row["bio"]; ?>"></textarea>
            <span></span>
        </div>
        <div>
            <span>E-mail</span>
            <input type="email" name="email" value="<?php echo $row["email"]; ?>">
            <span></span>
        </div>
        <div>
            <span>Celular</span>
            <input type="text" name="celular" placeholder="(xx) x xxxx-xxxx" value="<?php echo $row["celular"]; ?>">
            <span></span>
        </div>
        <div>
            <span>Discord</span>
            <input type="text" name="discord" placeholder="nome#xxxx" value="<?php echo $row["discord"]; ?>">
            <span></span>
        </div>
        <div>
            <span>Matrícula UFC</span>
            <input type="number" name="matricula" value="<?php echo $row["matricula"]; ?>">
            <span></span>
        </div>
        <div>
        <button class="btn btn-success" type="submit">Salvar</button>
        </div>
    </form>
</body>
</html>