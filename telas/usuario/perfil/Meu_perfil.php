<?php 
    //Script do meu perfil

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    require_once 'C:\xampp\htdocs\projeto-webapp-taverna\db\config.php';

    //Inicializa variáveis vazias
    $foto = $nome = $bio = $email = $celular = $discord = $matricula = "";

    //Preparando a requisição ao banco
    $sql = "SELECT foto, nome, bio, email, celular, discord, matricula
            FROM usuario
            WHERE id = (?)
            LIMIT 1";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        $param_id = $_SESSION["id"];

        //Executando a requisição ao banco
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
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil</title>
    <link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="../Usuario_dashboard.php">Taverna</a>
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
                            <a class="nav-link" href="../Usuario_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Editar_perfil.php">Editar perfil</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center mt-3">
        <!-- Conteúdo da página -->
        <h1 class="p-3">Meu perfil</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Foto</span>  
                        <!--<input type="file" name="foto" class="form-control">-->
                        <img src="../../../assets/fav.png" alt="foto-perfil" name="foto" class="img">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 400px;">   
                        <span class="input-group-text">Nome Completo</span>
                        <input type="text" name="nome" value="<?php echo $row["nome"]; ?>" class="form-control" readonly>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 400px;">
                        <span class="input-group-text">Bio</span>
                        <textarea name="bio" cols="30" rows="10" placeholder="<?php echo $row["bio"]; ?>" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">E-mail</span>
                        <input type="email" name="email" value="<?php echo $row["email"]; ?>" class="form-control" readonly>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">Celular</span>
                        <input type="text" name="celular" placeholder="(xx) x xxxx-xxxx" value="<?php echo $row["celular"]; ?>" class="form-control" readonly>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">Discord</span>
                        <input type="text" name="discord" placeholder="nome#xxxx" value="<?php echo $row["discord"]; ?>" class="form-control" readonly>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">Matrícula UFC</span>
                        <input type="number" name="matricula" value="<?php echo $row["matricula"]; ?>" class="form-control" readonly>
                    </div>
                </div>
            </div>   
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>