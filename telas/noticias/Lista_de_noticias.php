<?php 
    //Script da lista de mesas

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    error_reporting(E_ALL ^ E_WARNING);
    ini_set("display_errors", 1 );

    //Validação para impedir que o usuário que não logou entre no dashboard
    if(empty($_SESSION)){
        echo "<script>location.href='login/Login.php';</script>";
    }

      echo '<!DOCTYPE html>';
      echo '<html lang="pt-br">';
      echo '<head>';
      echo '<meta charset="UTF-8">';
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
      echo '<title>Lista de notícias</title>';
      echo '<link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">';
      echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">';
      echo '<link href="../../css/standard.css" rel="stylesheet">';
      echo '<link href="../../css/lista_de_noticias.css" rel="stylesheet">';
      echo '</head>';
      echo '<body class="bg-light">';
      echo '<header class="sticky-top" id="h">';
            echo "<a class='navbar-brand' href='../usuario/Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>";
            echo "<nav>";
            echo "<div class='container-fluid'>";
            echo '<div>';
            echo '<img src="../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">';
            echo "<form class='form-inline' action='../pesquisar.php' method='post' style='margin-top:0.6em;'>";
            echo "<div style='display:flex;'>";
            echo "<input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>";
            echo "</div>";
            echo "</form>";
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu">';
            echo '<a class="dropdown-item" href="../mesa/Lista_de_mesas.php">Lista de mesas</a>';
            echo '<a class="dropdown-item" href="../mesa/Minhas_mesas.php">Minhas mesas</a>';
            echo '<a class="dropdown-item" href="../mesa/Cadastro_mesa.php">Cadastrar mesa</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="Lista_de_noticias.php">Feed de notícias</a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="dropdown">';
            echo '<button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>';
            echo '<div class="dropdown-menu dropdown-menu-lg-end">';
            echo '<a class="dropdown-item" href="../usuario/perfil/Perfil.php">Meu perfil</a>';
            echo '<a class="dropdown-item" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>';
            echo '<hr class="dropdown-divider">';
            echo '<a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>';
            echo '</div>';
            echo '</div>';
            echo "</div>";
            echo '</div>';
            echo "</nav>";
            echo '</header>';
      echo '<main style="background-image: url(../../assets/images/fundo-lista-noticiass.png); background-size: cover; background-repeat: no-repeat; background-position: center;">';
      echo '<div class="container-fluid text-center" style="width: 900px; position: relative; top: 6em;">';
      echo '<h1 class="p-4" id="titulo">Feed de Notícias</h1>';

    //Prepara a requisição ao banco
    if(isset($_GET["id"])){ 
        $sql = "SELECT * FROM noticia WHERE id > {$_GET["id"]}  ORDER BY id LIMIT 5 ";
    } else{
        $sql = "SELECT * FROM noticia ORDER BY id LIMIT 5";
    }
    if(isset($_GET["idVoltar"])){ 
        if($_GET["idVoltar"] == ""){
            $sql = "SELECT * FROM noticia ORDER BY id LIMIT 5";
        }else{
            $idfirst = $_GET["idVoltar"] - 4;
            $idLimit = $idfirst - 6;
            $sql = "SELECT * FROM noticia WHERE id < {$idfirst} AND id > {$idLimit}  ORDER BY id  LIMIT 5 ";
        }
    } 

    $stmt = $mysqli->query($sql);

    $qtd = $stmt->num_rows;

    //Renderiza os dados na forma de tabela
    if($qtd > 0){
        echo "<table class='table table-hover table-striped table-bordered' style='width:800px; margin:auto;'>";
            echo "<tr>";
            echo "<th>Autor</th>";
            echo "<th>Título</th>";
            echo "<th>Subtítulo</th>";
            echo "<th>Data</th>";
            echo "<th>Ações</th>";
            echo "</tr>";
        while($row = $stmt->fetch_object()){
            echo "<tr>";
            echo "<td>" . $row->apelido_admin . "</td>";
            echo "<td>" . $row->titulo . "</td>";
            echo "<td>" . $row->subtitulo . "</td>";
            echo "<td>" . $row->data . "</td>";
            $id = $row -> id;
        if($_SESSION["admin"] == 0){
            echo "<td>
            <button class='btn' style='background-color: #134F59; color: white;' onclick=\"location.href='Noticia_dashboard.php?id=".$row->id."';\">+</button>
                  </td>";        
            echo "</tr>";
        }else if($_SESSION["admin"] == 1){
            echo "<td>
                    <button class='btn btn-success' onclick=\"location.href='Mesa_dashboard.php?id=".$row->id."';\">Acesse</button>
                    <button class='btn btn-danger' onclick=\"location.href='Lista_de_noticias.php?name=$row->id';\">Excluir</button>
            </td>"; 
        }
    }
        echo "</table>";
        echo '<div style="display: flex; justify-content: space-between;">';
        echo "<button id='botaoControle' onclick=\"location.href='lista_de_noticias.php?idVoltar=$id';\">Voltar</button>";
        echo "<button id='botaoControle' onclick=\"location.href='lista_de_noticias.php?id=$id';\">Próxima Página</button>";
        echo '</div>';
        echo '</div>';
        
        if(isset($_GET["name"])){
            $name = $_GET["name"];
            $sql = "DELETE FROM noticia WHERE id = $name";
            $stmt = $mysqli->query($sql);
        }
    } else {
        echo "<h3 class='text-danger'>Não encontrou resultados!</h3>";
        echo '<div style="display: flex; justify-content: space-between;">';
        echo "<button id='botaoControle' onclick=\"location.href='lista_de_noticias.php?idVoltar=$id';\">Voltar</button>";
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</main>';
    echo '<footer>';
            echo '<div class="container-fluid">';
            echo '<p>&copy; A Guilda. Siga em frente!</p>';
            echo '<p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>';
            echo '</div>';
            echo '</footer>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>';
    echo '</body>';
    echo '</html>';

?>