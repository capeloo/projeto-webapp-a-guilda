<?php
    //Script do escrever notícia
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $apelido_admin = $titulo = $subtitulo = $foto = $texto = "";

        $apelido_admin = $_SESSION["apelido"];
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        
        if(isset($_FILES['foto'])){
            $arquivo = $_FILES['foto']['name'];
            //Diretório para uploads 
            $pasta_dir = '../../../assets/';
            $arquivo_nome = $pasta_dir . $arquivo; 
            // Faz o upload da imagem
            move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo_nome); 
        }

        $texto = $_POST["texto"];

        $sql = "INSERT INTO noticia (apelido_admin, titulo, subtitulo, foto, texto)
                VALUES (?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssss", $param_apelido_admin, $param_titulo, $param_subtitulo, $param_foto, $param_texto);
            
            $param_apelido_admin = $apelido_admin;
            $param_titulo = $titulo;
            $param_subtitulo = $subtitulo;
            $param_foto = $arquivo_nome;
            $param_texto = $texto;

            //Executa a requisição
            if($stmt->execute()){
                echo "<script>alert('Notícia publicada com sucesso!');</script>";
                echo "<script>location.href='../Usuario_dashboard.php';</script>";
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        
            //Fecha a conexão com o banco
            $stmt->close();
        }

        //Fecha a conexão com o banco (de novo)
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
    <title>Escrever Notícia</title>
    <link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <!-- Barra de navegação -->
    <nav class='navbar bg-light sticky-top'>
        <div class='container-fluid'>
            <a class='navbar-brand text-dark' href='../Usuario_dashboard.php'>Taverna</a>
            <form class='form-inline' action='../../pesquisar.php' method='post'>
                <div style='display:flex;'>
                    <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
                    <button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
                </div>
            </form>
            <button class='navbar-toggler bg-light' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasNavbar' aria-labelledby='offcanvasNavbarLabel'>
                <div class='offcanvas-header'>
                    <h5 class='offcanvas-title' id='offcanvasNavbarLabel'>Menu</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>
                </div>
            <div class='offcanvas-body'>
                <ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>
                    <li class='nav-item'>
                        <strong>Perfil</strong>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='../perfil/Lista_perfis.php'>Lista de perfis</a>
                    </li>
                    <li class='nav-item' style='margin-top: 10px;'>
                    <li class='nav-item'>
                        <strong>Mesa</strong>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='../../mesa/Lista_de_mesas.php'>Lista de mesas</a>
                    </li>
                    <li class='nav-item' style='margin-top: 10px;'>
                        <strong>Denúncia</strong>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='../denuncia/Lista_denuncia.php'>Tickets de Denúncia</a>
                    </li>
                    <li class='nav-item'>
                    <li class='nav-item' style='margin-top: 10px;'>
                        <strong>Notícias</strong>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='Escrever_noticia.php'>Escrever Notícia</a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-3">
        <h1 class="p-3 text-light">Escrever Notícia</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="input-group mx-auto p-2" style="width: 400px;">
                    <span class="input-group-text" style="font-size: 1.2em;">Título</span>
                    <input type="text" name="titulo" class="form-control">
                </div> 
                <div class="input-group mx-auto p-2" style="width: 800px;">
                    <span class="input-group-text" style="font-size: 1.2em;">Subtítulo</span>
                    <input type="text" name="subtitulo" class="form-control">
                </div>
                <div class="input-group mx-auto p-2" style="width: 800px;">
                    <span class="input-group-text" style="font-size: 1.2em;">Imagem</span>  
                    <input type="file" name="foto" style="font-size: 1.2em;" class="form-control">
                </div>
                <div class="input-group mx-auto p-2" style="width: 800px; height: 600px;">
                    <span class="input-group-text" style="font-size: 1.2em;">Texto</span>
                    <textarea name="texto" class="form-control" cols="30" row="10" style="width: 600px; height: 600px;"></textarea> 
                    <div class="p-4" style="width: 800px;">
                        <button class="btn btn-success" type="submit" style="width: 120px;">Publicar</button>
                    </div> 
                <div>  
            </div>  
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>