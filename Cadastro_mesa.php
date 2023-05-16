<!-- 
Revisão:
    De acordo com o nosso System Design a nomeação dos arquivos deve seguir 
    o padrão de arquivos que são telas, iniciam com a letra maiúscula e os
    espaços devem ser _ (underline), já os que são apenas configurações ou 
    funcionalidades devem iniciar com a letra minúscula.

    O usuário deve estar logado nessa página, logo é necessário iniciar a ses-
    ssão usando session_start() e uma simples validação que não deixe ele acessar
    essa página sem ter logado.

-->

<!-- 
Basicamente tenho que refazer essa bosta sem PDO e meter o MySQLi
Tentar meter os dados do cara logado à mesa quando ela for criada
Lembrar também de usar o computador alheio pra abrir o banco de dados pra n travar
-->

<?php
session_start();
require_once "config.php";

$nome = $sistema = "";
$nome_erro = $sistema_erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["nome"]))) {
        $nome_erro = "Por favor, dê um nome para a sua campanha.";
    } else {
        // Essa query deveria ser para validar se já existe uma mesa com o nome solicitado?
        // Se sim, tem que refatorar. Além disso, estamos utilizando o objeto mySQLi para fazer
        // a conexão com o banco. Logo refatorar com isso em conta também. Ademais, lembre de 
        // usar a função close() para fechar a conexão com o banco.

        //Trocar para selecionar o id do usuário de acordo com o seu LOGIN
        $sql = "SELECT id from usuario WHERE nome = (?)";

        if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param('s', $parametro_nome);
            $parametro_nome = trim($_POST["nome"]);
            if($stmt->execute()) {
                $stmt_res =  $stmt->get_result();
                if($stmt_res->num_rows == 1) {
                    $nome_erro = "Esse nome de campanha já existe.";
                } else {
                    $nome = trim($_POST["nome"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor tente novamente mais tarde.";
            }
            $stmt->close();
        }
    }
        if(empty(trim($_POST["sistema"]))) {
            $sistema_erro = "Por favor, determine um sistema de jogo para a sua campanha.";
        } else {
            $sistema = trim($_POST["sistema"]);
        }
    }
        if(empty($nome_error) && empty($sistema_error)) {
            $sql = "INSERT INTO mesas (nome, sistema) VALUES (?, ?)";
            if($stmt = $mysqli->prepare($sql)) {
            $stmt->bindParam("ss", $parametro_nome);
            $parametro_nome = $nome;
            $parametro_sistema = $sistema;
            if($stmt->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>location.href='Login.php';</script>";
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            $stmt->close();
    }
   $mysqli->close();
}
?>
<!-- 
    Está faltando a tag <form action="" method=""></form> que é necessária para receber
    o input do usuário e dizer como (method) e para onde (action) essas dados serão envi-
    ados. Além disso, peço que se atente a indentação do código para melhorar a legibilidade.

    Por fim, precisamos nos reunir para pensarmos melhor como será feito o backend das mesas.
    Os campos da tabela e a forma que ela vai se conectar com a tabela usuário.
-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de mesa | A Taverna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid text-center mt-4">
        <h1 class="display-4 p-3">Criar uma nova mesa</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Nome da mesa</span>
                <input type="text" name="nome" class="form-control <?php echo (!empty($nome_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                <span class="invalid-feedback"><?php echo $nome_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Sistema</span>
                <input type="text" name="sistema" class="form-control <?php echo (!empty($sistema_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $sistema; ?>">
                <span class="invalid-feedback"><?php echo $sistema_erro; ?></span>
            </div>
            <div class="p-4">
                <button class="btn btn-success" type="submit">Cadastrar nova mesa</button>
                <button class="btn btn-danger" type="reset">Apagar dados da mesa</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
