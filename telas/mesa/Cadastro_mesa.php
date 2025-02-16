<?php
    //Script do cadastro de mesa

    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
    session_start();

    //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    //Inicializando variáveis vazias
    $id_mestre = $email_mestre = $nome_mestre = $matricula_mestre = $celular_mestre = "";

    //Preparando a requisição ao banco para trazer os dados do mestre
    $sql = "SELECT nome, 
                   matricula,
                   email,
                   celular
            FROM usuario
            WHERE id = (?)";
    
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

    //Inicializando variáveis vazias (1)
    $foto = $tema = $nome_campanha = $sistema = $sinopse = $requisitos = $duracao = $classificacao = $vagas = $nivel = $data = $hora = "";

    $foto_erro = $tema_erro = $nome_campanha_erro = $sistema_erro = $sinopse_erro = $requisitos_erro = $duracao_erro = $classificacao_erro = $vagas_erro = $nivel_erro = $data_erro = $hora_erro = "";

    //Ao receber os dados dos formulários
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //A fazer:
        //  1. Decidir as validações dos campos;
        //  2. Codar as validações;
        $id_mestre = $_SESSION["id"];

        $email_mestre = $row["email"];

        $nome_mestre = $row["nome"];

        $matricula_mestre = $row["matricula"];

        $celular_mestre = $row["celular"];

        if(isset($_FILES['foto'])){
            $arquivo = $_FILES['foto']['name'];
            //Diretório para uploads 
            $pasta_dir = '../../assets/images/';
            $arquivo_nome = $pasta_dir . $arquivo; 
            // Faz o upload da imagem
            move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo_nome); 
        } 
        
        //errado, tá passando só o primeiro option!
        if(isset($_POST["tema"]) == null){
            "";
        } else {
            $tema = $_POST["tema"];
        }
        
        $nome_campanha = trim($_POST["nome_campanha"]);
        $sistema = trim($_POST["sistema"]);
        $sinopse = trim($_POST["sinopse"]);
        $requisitos = trim($_POST["requisitos"]);
        $duracao = trim($_POST["duracao"]);
        $classificacao = trim($_POST["classificacao"]);
        $vagas = trim($_POST["vagas"]);
        $nivel = trim($_POST["nivel"]);
        //Refatorar a data para mostrar dd/mm/aaaa
        $data = trim($_POST["data"]);
        $hora = trim($_POST["hora"]);

        //Caso nenhum erro ocorra na validação
        if(empty($foto_erro) && empty($tema_erro) && empty($nome_campanha_erro) && empty($sistema_erro) && empty($sinopse_erro) && empty($requisitos_erro) && empty($duracao_erro) && empty($classificacao_erro) && empty($vagas_erro) && empty($nivel_erro) && empty($data_erro) && empty($hora_erro)) {
            // A fazer:
            //  1. Incluir os dados do mestre na query;
            //Prepara a requisição ao banco
            $sql = "INSERT INTO mesa (id_mestre, email_mestre, nome_mestre, matricula_mestre, celular_mestre,foto, tema, nome_campanha, sistema, sinopse, requisitos, duracao, classificacao_indicativa, numero_vagas, nivel_jogadores, data, hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ississsssssssisss", $id_mestre, $email_mestre, $nome_mestre, $matricula_mestre, $celular_mestre, $param_foto, $param_tema, $param_nome_campanha, $param_sistema, $param_sinopse, $param_requisitos, $param_duracao, $param_classificacao, $param_vagas, $param_nivel, $param_data, $param_hora);

                $param_foto = $arquivo_nome;
                $param_tema = $tema;
                $param_nome_campanha = $nome_campanha; 
                $param_sistema = $sistema;
                $param_sinopse = $sinopse;
                $param_requisitos = $requisitos;
                $param_duracao = $duracao;
                $param_classificacao = $classificacao;
                $param_vagas = $vagas;
                $param_nivel = $nivel;
                $param_data = $data;
                $param_hora = $hora;
            
            //Executa a requisição
            if($stmt->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                //Redireciona para o dashboard da mesa
                echo "<script>location.href='../usuario/Usuario_dashboard.php';</script>";
            } else {
                echo "Ops! Algo deu errado. (1)";
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
    <title>Cadastro de mesa</title>
    <link rel="shortcut icon" href="../../assets/images/faviconnn.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Folha do multi-select-tag -->
    <link href="../../css/multi-select-tag.css" rel="stylesheet">
    <link href="../../css/standard.css" rel="stylesheet">
    <link href="../../css/cadastro_mesa.css" rel="stylesheet">
</head>
<body>
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
                            <a class="dropdown-item" href="Lista_de_mesas.php">Lista de mesas</a>
                            <a class="dropdown-item" href="Minhas_mesas.php">Minhas mesas</a>
                            <a class="dropdown-item" href="Cadastro_mesa.php">Cadastrar mesa</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/noticias.png" style="width: 2.8em;"></button>
                        <div class="dropdown-menu dropdown-menu-lg-end">
                            <a class="dropdown-item" href="../noticias/Lista_de_noticias.php">Feed de notícias</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../assets/images/pessoa.png" style="width: 2.8em;"></button>
                        <div class="dropdown-menu dropdown-menu-lg-end">
                            <a class="dropdown-item" href="../usuario/perfil/Perfil.php">Meu perfil</a>
                            <a class="dropdown-item" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="../usuario/login/logout.php">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <!-- Conteúdo da página -->
        <section class="text-center">
            <h1 class="p-3">Cadastrar mesa</h1>
        </section>
            <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <input type="file" name="foto">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 350px; height: 300px; background-size: contain; background-repeat: no-repeat; background-image: url(../../assets/images/quadro.png);">
                    </div>
                </div>
                    <div class="col">
                        <div class="input-group mx-auto p-2" style="width: 350px;">
                            <input type="text" id="nome-campanha" name="nome_campanha" class="form-control <?php echo (!empty($nome_campanha_erro)) ? 'is-invalid' : ''; ?>" placeholder="Noma da Campanha" style="background-color: #8FBEAE; border-radius: 0.2em;">
                            <span class="invalid-feedback"><?php echo $nome_campanha_erro; ?></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 350px;">
                            <input type="text" id="sistema" name="sistema" class="form-control <?php echo (!empty($sistema_erro)) ? 'is-invalid' : ''; ?>" placeholder="Sistema" style="background-color: #8FBEAE; border-radius: 0.2em;">
                            <span class="invalid-feedback"><?php echo $sistema_erro; ?></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 350px; height: 150px;">
                            <textarea name="sinopse" id="sinopse" class="form-control" style="background-color: #8FBEAE; border-radius: 0.2em;" placeholder="Sinopse"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 350px;">
                            <textarea name="requisitos" id="requisitos" class="form-control" style="background-color: #8FBEAE; border-radius: 0.2em;" placeholder="Requisitos Mínimos"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <select name="duracao" id="select" class="form-control" style="background-color: #8FBEAE; border-radius: 0.2em;">
                                <option>Duração</option>
                                <option>One-shot</option>
                                <option>Curta</option>
                                <option>Média</option>
                                <option>Longa</option>
                                <option>Odisseia</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <select name="classificacao" id="select1" class="form-control" style="background-color: #8FBEAE; border-radius: 0.2em;">
                                <option>Classificação Indicativa</option>
                                <option>L</option>
                                <option>10</option>
                                <option>12</option>
                                <option>14</option>
                                <option>16</option>
                                <option>18</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <input type="number" id="vagas" class="form-control" name="vagas" placeholder="Vagas" style="background-color: #8FBEAE; border-radius: 0.2em;">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <select name="nivel" id="select2" class="form-control" style="background-color: #8FBEAE; border-radius: 0.2em;">
                                <option>Nível dos Jogadores</option>
                                <option>Livre</option>
                                <option>Iniciante</option>
                                <option>Intermediário</option>
                                <option>Avançado</option>
                                <option>Mestre</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <input type="date" id="data" class="form-control" name="data" placeholder="Data" style="background-color: #8FBEAE; color: #134F59;  border-radius: 0.2em;">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="input-group mx-auto p-2" style="width: 300px;">
                            <input type="time" class="form-control" name="hora" placeholder="Hora"style="background-color: #8FBEAE; color: #134F59;  border-radius: 0.2em;">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>  
                <div class="p-4 text-center">
                    <button class="btn" style="font-family: Rakkas; font-size: 1.2em; background-color: #134F59; color: white; width: 120px;" type="submit">Cadastrar</button>
                </div>
            </form>
    </main>
    <footer>
        <div class="container-fluid">
            <p>&copy; A Guilda. Siga em frente!</p>
            <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../assets/images/insta-icon (3).png"></a></p>
        </div>
    </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script do multi-select-tag -->
    <script src="../../js/multi-select-tag.js"></script>
    <script>
      new MultiSelectTag('theme')  // id
    </script>
</body>
</html>
