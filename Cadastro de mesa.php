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
$nome_error = $sistema_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["nome"]))) {
        $nome_error = "Por favor, dê um nome para a sua campanha.";
    } else {
        // Essa query deveria ser para validar se já existe uma mesa com o nome solicitado?
        // Se sim, tem que refatorar. Além disso, estamos utilizando o objeto mySQLi para fazer
        // a conexão com o banco. Logo refatorar com isso em conta também. Ademais, lembre de 
        // usar a função close() para fechar a conexão com o banco.

        //Trocar para selecionar o id do usuário de acordo com o seu LOGIN
        $sql = "SELECT id from usuario WHERE nome = (?)";
        if($stmt = $pdo->prepare($sql)) {
            $stmt->bind_param(":nome", $parametro_nome, PDO::PARAM_STR);
            $parametro_nome = trim($_POST["nome"]);
            if($stmt->execute()) {
                if($stmt->rowCount() == 1) {
                    $nome_error = "Esse nome de campanha já existe.";
                } else {
                    echo "Algo deu errado, por favor, tente novamente.";
                }
                unset($stmt);
            }
        }
        if(empty(trim($_POST["sistema"]))) {
            $sistema_error = "Por favor, determine um sistema de jogo para a sua campanha.";
        } else {
            $sistema = trim($_POST["sistema"]);
        }
    }
        if(empty($nome_error) && empty($sistema_error)) {
            $sql = "INSET INTO mesas (nome, sistema) VALUES (:nome, :sistema)";
            if($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nome", $param_nome, PDO::PARAM_STR);
            $stmt->bindParam(":sistema", $parametro_sistema, PDO::PARAM_STR);
            $parametro_nome = $nome;
            $parametro_sistema = $sistema;
            if($stmt->execute()) {
                // Aqui precisamos decidir para onde o usuário será redirecionado após o cadastro
                // de mesa. A princípio eu prefiro que leve ou para minhas mesas ou para lista de
                // mesas. 
                header("location: login.php");
            } else {
                echo "Algo deu errado, por favor tente novamente.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de mesa | A Taverna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- 
    Está faltando a tag <form action="" method=""></form> que é necessária para receber
    o input do usuário e dizer como (method) e para onde (action) essas dados serão envi-
    ados. Além disso, peço que se atente a indentação do código para melhorar a legibilidade.

    Por fim, precisamos nos reunir para pensarmos melhor como será feito o backend das mesas.
    Os campos da tabela e a forma que ela vai se conectar com a tabela usuário.
-->
    <div class="wrapper">
        <h2>Cadastro de mesa</h2>
        <p>Por favor, preencha as informações básicas sobre a sua mesa abaixo.<p>
            <div>
                <div>
                    <div class="form-group">
                    <label>Nome da campanha</label>
                <input type="text" name="nome" class="form-control <?php echo (!empty($nome_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                <span class="invalid-feedback"><?php echo $nome_error; ?></span>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                    <input type="text" name="sistema" class="form-control <?php echo (!empty($sistema_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $sistema; ?>">
                <span class="invalid-feedback"><?php echo $sistema_error; ?></span>
                    </div>
                </div>
                <div class="form-group">
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Criar mesa">
            </div>
                </div>
</div>
</body>
</html>
