<?php
    session_start();

    require 'C:\xampp\htdocs\projeto-webapp-taverna\db\config.php';

    $sql = "SELECT *
            FROM usuario
            WHERE id = (?);
            ";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param('i', $param_id);
        $param_id = $_SESSION["id"];

        if($stmt->execute()){
            $stmt_res = $stmt->get_result();

            if($stmt_res-> num_rows == 1){
                $row = $stmt_res->fetch_assoc();
            } else {
                echo "Ops! Algo deu errado. (0)";
            }
        } else {
            echo "Ops! Algo deu errado. (1)";
        }
        // Fecha a conexão com o banco
        $stmt->close();
    }

    echo $row['apelido'];

      //pegar o apelido do usuário por meio da variável de sessão apelido
      //inserir o valor apelido no campo participantes da tabela mesa (com vírgula!)
      //selecionar o campo numero_vagas da tabela mesa e guardar o valor
      //atualizar o campo numero_vagas com o decréscimo de 1 do valor
      //mostrar na tela o resultado positivo ou negativo
      //caso o resultado seja positivo, redirecionar o usuário para a tela Minhas mesas
   
?>