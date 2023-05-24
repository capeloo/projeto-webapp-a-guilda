<?php
    session_start();

    require 'C:\xampp\htdocs\projeto-webapp-taverna\db\config.php';

    $sql = "UPDATE mesa 
            SET participantes = (?) 
            WHERE id = (?) 
            ";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param('si', $param_apelido, $param_id);
        $param_apelido = $_SESSION["apelido"] . ';';
        $param_id = $_GET["id"];

        if($stmt->execute()){
            echo "<script>alert('Incrição realizada com sucesso!');</script>";
            echo "<script>location.href='Minhas_mesas.php';</script>";
        } else {
            echo "Ops! Algo deu errado. (0)";
        }
        // Fecha a conexão com o banco
        $stmt->close();
    }

    //pegar o apelido do usuário por meio da variável de sessão apelido
    //inserir o valor apelido no campo participantes da tabela mesa (com ponto e vírgula!)

    $sql = "SELECT numero_vagas
            FROM mesa
            WHERE id = (?)
            ";
    
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param('i', $param_id);
        $param_id = $_GET["id"];

        if($stmt->execute()){
            $stmt_res = $stmt->get_result();

            if($stmt_res->num_rows == 1){
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
      

      //selecionar o campo numero_vagas da tabela mesa e guardar o valor
      //atualizar o campo numero_vagas com o decréscimo de 1 do valor
      //mostrar na tela o resultado positivo ou negativo
      //caso o resultado seja positivo, redirecionar o usuário para a tela Minhas mesas
   
?>