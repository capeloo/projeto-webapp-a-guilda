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
            $pasta_dir = '../../assets/';
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
    <link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/multi-select-tag.css" rel="stylesheet">
    <link href="../../css/standard.css" rel="stylesheet">
    <link href="../../css/escrever_noticia.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <!-- Barra de navegação -->
    <header class="sticky-top" id="h">
      <a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
      <nav>
      <div class='container-fluid'>
      <div>
      <img src="../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">
      <form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>
      <div style='display:flex;'>
      <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
      </div>
      </form>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="../mesa/Lista_de_mesas.php">Lista de mesas</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../noticias/Escrever_noticia.php">Escrever notícia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-identificação-não-verificada-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../usuario/denuncia/Lista_denuncia.php">Tickets de denúncia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../usuario/perfil/Lista_perfis.php">Lista de perfis</a>
      <hr class="dropdown-divider">
      <a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>
      </div>
      </div>
      </div>
      </div>
      </nav>
      </header>

    <!-- Conteúdo da página -->
    <main>
    <div class="container-fluid text-center">
        <h1 class="pt-5 pb-3">Escrever Notícia</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="input-group mx-auto p-2" style="width: 400px;">
                    <input type="text" name="titulo" id="i1" class="form-control" placeholder="Título" style="background-color: #8FBEAE;">
                </div> 
                <div class="input-group mx-auto p-2" style="width: 800px;">
                    <input type="text" name="subtitulo" id="i2" class="form-control" placeholder="Subtítulo" style="background-color: #8FBEAE;">
                </div>
                <div class="input-group mx-auto p-2" style="width: 800px;">  
                    <input type="file" name="foto">
                </div>
                <div class="input-group mx-auto p-2" style="width: 800px; height: 600px;">
                    <textarea name="texto" class="form-control" id="t1" cols="30" row="10" style="width: 600px; height: 600px; background-color: #8FBEAE;" placeholder="Escreva aqui!"></textarea> 
                <div>  
            </div> 
            <div class="p-4" style="width: 800px;">
                <button class="btn" type="submit" style="width: 120px; background-color:#134F59; font-family: Montagna LTD; color: white;">Publicar</button>
            </div>  
        </form>
    </div>
    </main>
    <footer>
        <div class="container-fluid">
        <p>&copy; A Guilda. Siga em frente!</p>
        <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>
        </div>
    </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>