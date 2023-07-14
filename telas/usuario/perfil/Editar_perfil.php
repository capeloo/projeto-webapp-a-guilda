<?php 
    //Script do editar perfil

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    //Inicializa variáveis vazias
    $foto = $apelido = $nome = $bio = $email = $celular = $discord = $matricula = "";
    $foto_erro = $apelido_erro = $nome_erro = $bio_erro = $email_erro = $celular_erro = $discord_erro = $matricula_erro = "";

    //Preparando a requisição ao banco
    $sql = "SELECT foto, apelido, nome, bio, email, celular, discord, matricula
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

        //Valida o apelido
        if (empty(trim($_POST["apelido"]))) {
            $apelido_erro = "Por favor coloque um nome.";
        } else {
            $apelido = trim($_POST["apelido"]);
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
        $celular = $_POST["celular"];

        //Valida discord
        $discord = $_POST["discord"];

        //Valida a matricula
        if(strlen(trim($_POST["matricula"])) < 6){
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
                        apelido = (?), 
                        nome = (?), 
                        bio = (?), 
                        email = (?), 
                        celular = (?), 
                        discord = (?), 
                        matricula = (?)
                    WHERE id = (?)
                    LIMIT 1";


            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("sssssssii", $param_foto, $param_apelido, $param_nome, $param_bio, $param_email,   $param_celular, $param_discord, $param_matricula, $param_id);
                $param_foto = $arquivo_nome;
                $param_apelido = $apelido;
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
    <link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/standard.css" rel="stylesheet">
    <link href="../../../css/editar_perfil.css" rel="stylesheet">
</head>
<body>
<header class="sticky-top" id="h">
            <a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
            <nav>
            <div class='container-fluid'>
            <div>
            <form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>
            <div style='display:flex;'>
            <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
            </div>
            </form>
            <div class="dropdown">
            <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
            <a class="dropdown-item" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>
            <a class="dropdown-item" href="../../mesa/Cadastro_mesa.php">Cadastrar mesa</a>
            </div>
            </div>
            <div class="dropdown">
            <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>
            <div class="dropdown-menu dropdown-menu-lg-end">
            <a class="dropdown-item" href="../../noticias/Lista_de_noticias.php">Feed de notícias</a>
            </div>
            </div>
            <div class="dropdown">
            <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>
            <div class="dropdown-menu dropdown-menu-lg-end">
            <a class="dropdown-item" href="Perfil.php">Meu perfil</a>
            <a class="dropdown-item" href="Editar_perfil.php">Editar perfil</a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="../login/logout.php">Sair</a>
            </div>
            </div>
            </div>
            </div>
            </nav>
            </header>
        <main style="background-image: url(../../../assets/images/editar-perfil.png); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <div class="container-fluid text-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col"> 
                            <div class="mx-auto p-2" style="width: 350px;">    
                                <input type="file" id="foto" name="foto">
                                <img src="<?php echo $row["foto"]; ?> "alt="foto-perfil" name="foto" class="img" width="280px" height="280px" >
                                <!--<span class="invalid-feedback"></span>-->
                            </div>
                        </div>
                        <div class="col">
                            <div class="mx-auto p-2" style="width: 250px;">
                                <input type="text" name="apelido" id="apelido" value="<?php echo $row["apelido"]; ?>" placeholder="Apelido" class="form-control <?php echo (!empty($apelido_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $apelido_erro; ?></span>-->
                            </div>
                            <div class="mx-auto p-2" style="width: 400px;"> 
                                <input type="text" name="nome" id="nome" value="<?php echo $row["nome"]; ?>" placeholder="Nome" class="form-control <?php echo (!empty($nome_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $nome_erro; ?></span>-->
                            </div>
                            <div class="mx-auto p-2" style="width: 400px;">
                                <input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>" placeholder="E-mail" class="form-control <?php echo (!empty($email_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $email_erro; ?></span>-->
                            </div>
                            <div class="mx-auto p-2" style="width: 400px;">
                                <textarea name="bio" id="bio" placeholder="Bio" cols="30" rows="10" class="form-control <?php echo (!empty($bio_erro)) ? 'is-invalid' : ''; ?>"><?php echo $row["bio"]; ?></textarea>
                                <!--<span class="invalid-feedback"><?php echo $bio_erro; ?></span>-->
                            </div>
                        </div>
                        <div class="col">
                            <div class="mx-auto p-2" style="width: 250px;">
                                <input type="text" name="discord" id="discord" placeholder="Discord" value="<?php echo $row["discord"]; ?>" class="form-control <?php echo (!empty($discord_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $discord_erro; ?></span>-->
                            </div>
                            <div class="mx-auto p-2" style="width: 250px;">
                                <input type="text" name="celular" id="celular" placeholder="Celular" value="<?php echo $row["celular"]; ?>" class="form-control <?php echo (!empty($celular_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $celular_erro; ?></span>-->
                            </div>
                            <div class="mx-auto p-2" style="width: 250px;">
                                <input type="text" name="matricula" id="matricula" value="<?php echo $row["matricula"]; ?>" placeholder="Matrícula" class="form-control <?php echo (!empty($matricula_erro)) ? 'is-invalid' : ''; ?>">
                                <!--<span class="invalid-feedback"><?php echo $matricula_erro; ?></span>-->
                            </div>
                        </div>
                    </div>
                    <div class="p-4" id="btn">
                        <button class="btn btn-success" style="width: 120px;" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </main>
            <footer>
            <div class="container-fluid">
            <p>&copy; A Guilda. Siga em frente!</p>
            <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>
            </div>
            </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>