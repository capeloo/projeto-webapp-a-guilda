<?php
    session_start();
    
    require 'C:\xampp\htdocs\projeto-webapp-taverna\db\config.php';

    $sql = "SELECT id, numero_vagas, participantes
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
    }

    $JaEntrou = false;
    $row["participantes"];
    $inscritos = explode(";", $row["participantes"]);
    for($i = 0; $i < count($inscritos); $i++ ){
        if($inscritos[$i] == $_SESSION["apelido"]){
            echo "<script>alert('Você já está inscrito nesta mesa!');</script>";
            echo "<script>location.href='Lista_de_mesas.php';</script>";
            $JaEntrou = true;
        }
    }

    if($row["numero_vagas"] > 0 && !$JaEntrou){
        $sql = "UPDATE mesa 
                SET participantes = (?), numero_vagas = (?) 
                WHERE id = (?) 
            ";
    
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('sii', $param_apelido, $param_vagas, $param_id);
            $param_apelido = $row["participantes"] . $_SESSION["apelido"] . ';';
            $param_vagas = $row["numero_vagas"] - 1;
            $param_id = $_GET["id"];

            if($stmt->execute()){
                $id_mesa = $row["id"] . ';';
                $id_usuario = $_SESSION["id"];

                $sql = "UPDATE usuario 
                        SET mesas = '$id_mesa' 
                        WHERE id = $id_usuario
                        ";

                if($stmt = $mysqli->query($sql)){
                    echo "<script>alert('Incrição realizada com sucesso!');</script>";
                    echo "<script>location.href='Minhas_mesas.php';</script>";  
                }
            } else {
                echo "Ops! Algo deu errado. (2)";
            }

        } else {
                echo "Ops! Algo deu errado. (3)";
            }

        // Fecha a conexão com o banco
        $stmt->close();
    } else {
        echo "<script>alert('Não foi possível concluir a inscrição pois o número de vagas já foi preenchido.')</script>";
        echo "<script>location.href='Lista_de_mesas.php';</script>";
    }
?>