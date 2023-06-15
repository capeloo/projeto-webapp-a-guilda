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
            $pasta_dir = '../../assets/';
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
                echo "<script>location.href='Minhas_mesas.php';</script>";
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
    <link rel="shortcut icon" href="../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Folha do multi-select-tag -->
    <link href="../../css/multi-select-tag.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="../usuario/Usuario_dashboard.php">Taverna</a>
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
                            <a class="nav-link" href="../usuario/perfil/Perfil.php">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../usuario/perfil/Editar_perfil.php">Editar perfil</a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <strong>Mesas</strong>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Lista_de_mesas.php">Lista de mesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Cadastro_mesa.php">Cadastro de mesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Minhas_mesas.php">Minhas mesas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-3">
        <h1 class="p-3">Criar uma nova mesa</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <!-- A fazer: 
                            Codar para permitir a entrada de fotos no banco;
                    -->
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Foto</span>  
                        <input type="file" name="foto" class="form-control">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text" style="width: 283px; border-radius: 5px;justify-content:center;">Tema</span>
                        <select name="tema" id="theme" multiple>
                            <option>Ação</option>
                            <option>Aventura</option>
                            <option>Horror</option>
                            <option>Mistério</option>
                            <option>Body Building</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Nome da campanha</span>
                        <input type="text" name="nome_campanha" class="form-control <?php echo (!empty($nome_campanha_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $nome_erro; ?></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Sistema</span>
                        <input type="text" name="sistema" class="form-control <?php echo (!empty($sistema_erro)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $sistema_erro; ?></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Sinopse</span>
                        <textarea name="sinopse" class="form-control"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Requisitos</span>
                        <textarea name="requisitos" class="form-control"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Duração</span>
                        <select name="duracao" class="form-control">
                            <option></option>
                            <option>One-shot</option>
                            <option>Curta</option>
                            <option>Média</option>
                            <option>Longa</option>
                            <option>Odisseia</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Classificação Indicativa</span>
                        <select name="classificacao" class="form-control">
                            <option></option>
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
                        <span class="input-group-text">Número de vagas</span>
                        <input type="number" class="form-control" name="vagas">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Nível dos jogadores</span>
                        <select name="nivel" class="form-control">
                            <option></option>
                            <option>Livre</option>
                            <option>Iniciante</option>
                            <option>Intermediário</option>
                            <option>Avançado</option>
                            <option>Mestre</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Data</span>
                        <input type="date" class="form-control" name="data">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="input-group mx-auto p-2" style="width: 300px;">
                        <span class="input-group-text">Hora</span>
                        <input type="time" class="form-control" name="hora">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
            </div>  
            <div class="p-4">
                <button class="btn btn-success" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- Script do multi-select-tag -->
    <script src="../../js/multi-select-tag.js"></script>
    <script>
      new MultiSelectTag('theme')  // id
    </script>
</body>
</html>
