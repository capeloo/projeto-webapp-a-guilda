<?php 
    //Script do perfil

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    //Inicializa variáveis vazias
    $foto = $apelido = $bio = $email = $celular = $discord = $matricula = "";

    
    if($_SESSION["admin"] == 0){
        if(!empty($_GET["id"])){
            //Preparando a requisição ao banco
            $sql = "SELECT foto, nome, apelido, bio, email, celular, discord, matricula
                    FROM usuario
                    WHERE id = (?)
                    LIMIT 1";
    
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $param_id);
                $param_id = $_GET["id"];
    
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
    
            echo '<!DOCTYPE html>';
            echo '<html lang="pt-br">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>Perfil</title>';
            echo '<link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">';
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">'; 
            echo '<link href="../../../css/standard.css" rel="stylesheet">';
            echo '<link href="../../../css/perfil.css" rel="stylesheet">';
            echo '</head>';
            echo '<body>';
            echo '<header class="sticky-top" id="h">';
            echo "<a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
            echo "<nav>";
            echo "<div class='container-fluid'>";
            echo '<div>';
            echo "<form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/mesa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu">';
            echo '<a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>';
            echo '<a class="dropdown-item" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>';
            echo '<a class="dropdown-item" href="../../mesa/Cadastro_mesa.php">Cadastrar mesa</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="../../noticias/Lista_de_noticias.php">Feed de notícias</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="Perfil.php">Meu perfil</a>';
            echo '<a class="dropdown-item" href="Editar_perfil.php">Editar perfil</a>';
            echo '<hr class="dropdown-divider">';
            echo '<a class="dropdown-item" href="../login/logout.php">Sair</a>';
            echo '</div>';
            echo '</div>';
            echo "</div>";
            echo '</div>';
            echo "</nav>";
            echo '</header>';
            echo '<main style="background-image: url(../../../assets/images/perfilll.png); background-size: cover; background-repeat: no-repeat; background-position: center;">';
            echo '<div class="container-fluid text-center">';
            echo '<form action="' .htmlspecialchars($_SERVER["PHP_SELF"]). '"method="post">';
            echo '<div class="row">';
            echo '<div class="col">';  
            echo '<div class="mx-auto p-2" style="width: 350px;">';      
            echo '<img src="' .$row["foto"]. '"alt="foto-perfil" name="foto" class="img" width="280px" height="280px" >'; 
            echo '</div>'; 
            echo '</div>'; 
            echo '<div class="col">'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">';  
            echo '<h2 id="apelido">'.$row["apelido"].'</h2>'; 
            echo '</div>'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">';  
            echo '<h2 id="nome">'.$row["nome"].'</h2>'; 
            echo '</div>'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">'; 
            echo '<h2 id="bio">'.$row["bio"].'</h2>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col">';
            echo '<div class="mx-auto p-2" style="width: 350px;">';
            echo '<h2 id="discord">'.$row["discord"].'</h2>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            echo '<a href="../denuncia/Abrir_ticket.php?id='.$_GET["id"].'"class="btn mt-4" style="width: 120px; position: relative; top: 26em; left: 30em; background-color: #AA6857; font-family: Montagna LTD; color: #E8E0CB;">Denunciar</a>';
            echo '</div>';  
            echo '</main>';
            echo '<footer>';
            echo '<div class="container-fluid">';
            echo '<p>&copy; A Guilda. Siga em frente!</p>';
            echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>';
            echo '</div>';
            echo '</footer>';
            echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';  
            echo '</body>';
            echo '</html>';
        } else {
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

            echo '<!DOCTYPE html>';
            echo '<html lang="pt-br">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>Perfil</title>';
            echo '<link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">';
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
            echo '<link href="../../../css/standard.css" rel="stylesheet">';
            echo '<link href="../../../css/perfil.css" rel="stylesheet">';
            echo '</head>';
            echo '<body>';
            echo '<header class="sticky-top" id="h">';
            echo "<a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
            echo "<nav>";
            echo "<div class='container-fluid'>";
            echo '<div>';
            echo "<form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/mesa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu">';
            echo '<a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>';
            echo '<a class="dropdown-item" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>';
            echo '<a class="dropdown-item" href="../../mesa/Cadastro_mesa.php">Cadastrar mesa</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="../../noticias/Lista_de_noticias.php">Feed de notícias</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="Perfil.php">Meu perfil</a>';
            echo '<a class="dropdown-item" href="Editar_perfil.php">Editar perfil</a>';
            echo '<hr class="dropdown-divider">';
            echo '<a class="dropdown-item" href="../login/logout.php">Sair</a>';
            echo '</div>';
            echo '</div>';
            echo "</div>";
            echo '</div>';
            echo "</nav>";
            echo '</header>';
            echo '<main style="background-image: url(../../../assets/images/perfilll.png); background-size: cover; background-repeat: no-repeat; background-position: center;">';
            echo '<div class="container-fluid text-center">';
            echo '<form action="' .htmlspecialchars($_SERVER["PHP_SELF"]). '"method="post">';
            echo '<div class="row">';
            echo '<div class="col">';  
            echo '<div class="mx-auto p-2" style="width: 350px;">';      
            echo '<img src="' .$row["foto"]. '"alt="foto-perfil" name="foto" class="img" width="280px" height="280px" >'; 
            echo '</div>'; 
            echo '</div>'; 
            echo '<div class="col">'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">';  
            echo '<h2 id="apelido">'.$row["apelido"].'</h2>'; 
            echo '</div>'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">';  
            echo '<h2 id="name">'.$row["nome"].'</h2>'; 
            echo '</div>'; 
            echo '<div class="mx-auto p-2" style="width: 400px;">'; 
            echo '<h2 id="bio">'.$row["bio"].'</h2>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col">';
            echo '<div class="mx-auto p-2" style="width: 350px;">';
            echo '<h2 id="discord">'.$row["discord"].'</h2>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            echo '<div style="background-image: url(../../../assets/images/icons8-lixeira-50.png); width: 60px; height: 60px; background-size: cover; position:relative; top: 26.5em; left: 69.5em; cursor: pointer;><a href="excluir.php?id='.$_SESSION["id"].'" onclick="return confirm('."'Tem certeza que deseja excluir essa conta?'".')"></a></div>';
            echo '</div>';  
            echo '</main>'; 
            echo '<footer>';
            echo '<div class="container-fluid">';
            echo '<p>&copy; A Guilda. Siga em frente!</p>';
            echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>';
            echo '</div>';
            echo '</footer>';
            echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';  
            echo '</body>';
            echo '</html>';
        }
     } else if($_SESSION["admin"] == 1){
        //Preparando a requisição ao banco
        $sql = "SELECT id, foto, nome, bio, email, celular, discord, matricula
                FROM usuario
                WHERE id = (?)
                LIMIT 1";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            $param_id = $_GET["id"];

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

        echo '<!DOCTYPE html>';
        echo '<html lang="pt-br">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Perfil</title>';
        echo '<link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '</head>';
        echo '<body class="bg-dark">';
        echo '<nav class="navbar bg-light sticky-top">';
        echo '<div class="container-fluid">';
        echo '<a class="navbar-brand text-dark" href="../Usuario_dashboard.php">Taverna</a>';
        echo "<form class='form-inline' action='../../pesquisar.php' method='post'>";
        echo "<div style='display:flex;'>";
        echo "<input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>";
        echo "<button class='btn btn-outline-dark my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>";
        echo '</div>';
        echo '</form>';
        echo '<button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">';
        echo '<span class="navbar-toggler-icon"></span>';
        echo '</button>';
        echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">';
        echo '<div class="offcanvas-header">';
        echo '<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="offcanvas-body">';
        echo '<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">';
        echo '<li class="nav-item">';
        echo '<strong>Perfil</strong>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="Lista_perfis.php">Lista de perfis</a>';
        echo '</li>';
        echo '<li class="nav-item" style="margin-top: 10px;">';
        echo "<li class='nav-item'>";
        echo "<strong>Mesa</strong>";
        echo "</li>";
        echo "<li class='nav-item'>";
        echo "<a class='nav-link' href='../../mesa/Lista_de_mesas.php'>Lista de mesas</a>";
        echo "</li>";
        echo "<li class='nav-item' style='margin-top: 10px;'>";
        echo '<strong>Denúncia</strong>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="../denuncia/Lista_denuncia.php">Tickets de denúncia</a>';
        echo '</li>';
        echo '<li class="nav-item" style="margin-top: 10px;">';
        echo '<li class="nav-item">';
        echo '<strong>Notícias</strong>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="#">Escrever notícia</a>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        echo '<div class="container-fluid text-center mt-3">';
        echo '<h1 class="mt-5 mb-4 text-light text-center">Perfil</h1>';
        echo '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
        echo '<div class="row">';
        echo '<div class="col">';  
        echo '<div class="input-group mx-auto p-2" style="width: 400px;">';      
        echo '<span class="input-group-text" style="width: 350px; border-radius: 5px 5px 0px 0px;";>Foto</span> '; 
        echo '<img src="'.  $row["foto"] .'" alt="foto-perfil" name="foto" class="img" width="351px" height="260px" style="border-radius: 0px 0px 5px 5px;">'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '<div class="col">'; 
        echo '<div class="input-group mx-auto p-2" style="width: 400px;">'; 
        echo '<span class="input-group-text">Nome Completo</span>'; 
        echo '<input type="text" name="nome" value="' . $row["nome"] .'" class="form-control" disabled>'; 
        echo '</div>'; 
        echo '<div class="input-group mx-auto p-2" style="width: 400px;">'; 
        echo '<span class="input-group-text">Bio</span>';
        echo '<textarea name="bio" cols="30" rows="10" class="form-control" disabled>' . $row["bio"] . '</textarea>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col">';
        echo '<div class="input-group mx-auto p-2" style="width: 350px;">';
        echo '<span class="input-group-text">E-mail</span>';
        echo '<input type="email" name="email" value="' . $row["email"] . '" class="form-control" disabled>';
        echo '</div>';
        echo '<div class="input-group mx-auto p-2" style="width: 350px;">';
        echo '<span class="input-group-text">Celular</span>';   
        echo '<input type="text" name="celular" placeholder="(xx) x xxxx-xxxx" value="' . $row["celular"] .'" class="form-control" disabled>';
        echo '</div>';
        echo '<div class="input-group mx-auto p-2" style="width: 350px;">';
        echo '<span class="input-group-text">Discord</span>';
        echo '<input type="text" name="discord" placeholder="nome#xxxx" value="' . $row["discord"] .'" class="form-control" disabled>';
        echo '</div>';
        echo '<div class="input-group mx-auto p-2" style="width: 350px;">';
        echo '<span class="input-group-text">Matrícula UFC</span>';
        echo '<input type="number" name="matricula" value="' . $row["matricula"] . '" class="form-control" disabled>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '<a href="excluir.php?id='.$row["id"].'" onclick="return confirm('."'Tem certeza que deseja excluir essa conta?'".')" class="btn btn-danger mt-4" style="width: 120px;">Excluir</a>';
        echo '</div>';  
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';  
        echo '</body>';
        echo '</html>';
    }
?>

