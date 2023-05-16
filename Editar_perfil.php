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
    <link rel="shortcut icon" href="./Imagens/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="Pagina_inicial.php">Taverna</a>
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
                            <a class="nav-link" href="Meu_perfil.php">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Usuario_dashboard.php">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center mt-4">
        <!-- Conteúdo da página -->
        <h1 class="display-4 p-3">Editar perfil</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">Foto</span>  
                        <input type="file" name="foto" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 500px;">   
                        <span class="input-group-text">Nome Completo</span>
                        <input type="text" name="nome" value="<?php echo $row["nome"]; ?>" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">Bio</span>
                        <textarea name="bio" cols="30" rows="10" placeholder="<?php echo $row["bio"]; ?>" class="form-control"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">E-mail</span>
                        <input type="email" name="email" value="<?php echo $row["email"]; ?>" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">Celular</span>
                        <input type="text" name="celular" placeholder="(xx) x xxxx-xxxx" value="<?php echo $row["celular"]; ?>" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">Discord</span>
                        <input type="text" name="discord" placeholder="nome#xxxx" value="<?php echo $row["discord"]; ?>" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 500px;">
                        <span class="input-group-text">Matrícula UFC</span>
                        <input type="number" name="matricula" value="<?php echo $row["matricula"]; ?>" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
            </div>   
            <div class="p-4">
                <button class="btn btn-success" style="width: 150px;" type="submit">Salvar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>