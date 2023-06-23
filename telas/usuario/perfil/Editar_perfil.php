<?php 
    //Script do editar perfil

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    //Inicializa variáveis vazias
    $foto = $nome = $bio = $email = $celular = $discord = $matricula = "";
    $foto_erro = $nome_erro = $bio_erro = $email_erro = $celular_erro = $discord_erro = $matricula_erro = "";

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

    //Ao receber os dados do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){   
        if(isset($_FILES['foto'])){
            $arquivo = $_FILES['foto']['name'];
            //Diretório para uploads 
            $pasta_dir = '../../../assets/';
            $arquivo_nome = $pasta_dir . $arquivo; 
            // Faz o upload da imagem
            move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo_nome); 
        } 

        //Valida o nome
        if (empty(trim($_POST["nome"]))) {
            $nome_erro = "Por favor coloque um nome.";
        } else {
            $nome = trim($_POST["nome"]);
        }

        //Valida a bio
        if (empty(trim($_POST["bio"]))) {
            $bio_erro = "Por favor escreva um pouco sobre você!";
        } else {
            $bio = trim($_POST["bio"]);
        }

         //Valida o email
         if (empty(trim($_POST["email"]))) {
            $email_erro = "Por favor coloque um e-mail.";
        } else {
            $email = trim($_POST["email"]);
        }

        //Valida o celular
        if (is_numeric(trim($_POST["celular"]))) {
            $celular = $_POST["celular"];
        } else {
            $celular_erro = "Coloque um número de celular válido.";
        }

        //Valida discord
        $discord = $_POST["discord"];

        //Valida a matricula
        if(strlen(trim($_POST["matricula"])) < 6 || strlen(trim($_POST["matricula"]) > 8)){
            $matricula_erro = "Por favor coloque uma matrícula válida.";
        } else if (is_numeric(trim($_POST["matricula"]))) {
            $matricula = trim($_POST["matricula"]);
        } else {
            $matricula_erro = "Por favor coloque uma matrícula válida.";
        }

        //Se não houver nenhum erro de validação
        if(empty($foto_erro) && empty($nome_erro) && empty($bio_erro) && empty($email_erro) && empty($celular_erro) && empty($discord_erro) && empty($matricula_erro)){
            //Prepara a requisição para atualizar tabela usuario no banco
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
                $stmt->bind_param("ssssssii", $param_foto, $param_nome, $param_bio, $param_email,   $param_celular, $param_discord, $param_matricula, $param_id);
                $param_foto = $arquivo_nome;
                $param_nome = $nome;
                $param_bio = $bio;
                $param_email = $email;
                $param_celular = $celular;
                $param_discord = $discord;
                $param_matricula = $matricula;
                $param_id = $_SESSION["id"];
            
            //Executa a requisição
            if($stmt->execute()){
                echo "<script>alert('Edição realizada com sucesso!');</script>";
                //Redireciona para o dashboard
                echo "<script>location.href='Perfil.php';</script>";
            } else {
                echo "Ops! Algo deu errado. (2)";
            }
            // Fecha a conexão com o banco
            $stmt->close();
            }
        }
        // Fecha a conexão com o banco (de novo)
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
    <title>Editar perfil</title>
    <link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="../Usuario_dashboard.php">Taverna</a>
            <form class='form-inline' action='../../pesquisar.php' method='post'>
                <div style='display:flex;'>
                    <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
                    <button class='btn btn-outline-light my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
                </div>
            </form>
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
                            <strong>Perfil</strong>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Perfil.php">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Editar_perfil.php">Editar perfil</a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <strong>Mesas</strong>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Cadastro_mesa.php">Cadastro de mesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center mt-3">
        <!-- Conteúdo da página -->
        <h1 class="p-3">Editar perfil</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 400px;">
                        <span class="input-group-text">Foto</span>  
                        <input type="file" name="foto" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 400px;">   
                        <span class="input-group-text">Nome Completo</span>
                        <input type="text" name="nome" value="<?php echo $row["nome"]; ?>" class="form-control <?php echo (!empty($nome_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $nome_erro; ?></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 400px;">
                        <span class="input-group-text">Bio</span>
                        <textarea name="bio" cols="30" rows="10" class="form-control <?php echo (!empty($bio_erro)) ? 'is-invalid' : ''; ?>"><?php echo $row["bio"]; ?></textarea>
                        <span class="invalid-feedback"><?php echo $bio_erro; ?></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">E-mail</span>
                        <input type="email" name="email" value="<?php echo $row["email"]; ?>" class="form-control <?php echo (!empty($email_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $email_erro; ?></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width:350px;">
                        <span class="input-group-text">Celular</span>
                        <input type="text" name="celular" placeholder="(xx) x xxxx-xxxx" value="<?php echo $row["celular"]; ?>" class="form-control <?php echo (!empty($celular_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $celular_erro; ?></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">Discord</span>
                        <input type="text" name="discord" placeholder="nome#xxxx" value="<?php echo $row["discord"]; ?>" class="form-control">
                        <span class="invalid-feedback"><?php echo $discord_erro; ?></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px;">
                        <span class="input-group-text">Matrícula UFC</span>
                        <input type="text" name="matricula" value="<?php echo $row["matricula"]; ?>" class="form-control <?php echo (!empty($matricula_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $matricula_erro; ?></span>
                    </div>
                </div>
            </div>   
            <div class="p-4">
                <button class="btn btn-success" style="width: 120px;" type="submit">Salvar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>