<?php
    session_start();
    
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    if(isset($_GET["id"])){
        $id_dnc = $_GET["id"];
    }

    $sql = "SELECT apelido
            FROM usuario
            WHERE id = (?)";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("s", $param_id);
        $param_id = $id_dnc;

        if($stmt->execute()){
            $stmt_res = $stmt->get_result();
      
            if($stmt_res->num_rows == 1){
                $row = $stmt_res->fetch_assoc();
            }
        }
    }

    $apelido_denunciado = $row["apelido"];

    $add = "";
    $cb1 = $cb2 = $cb3 = $cb4 = $cb5 = $comentario = "";
    $motivo = array();
    
        for($i = 1; $i < 6; $i++){
            if(isset($_POST["cb". $i .""])){
                $add = $_POST["cb". $i .""];
                array_push($motivo, $add);
            }
        }
    
        $motivo_str = implode(";", $motivo);

        if(isset($_POST["comentario"])){
            $comentario = $_POST["comentario"];
        }

        if(isset($_POST["titulo"])){
            $titulo = $_POST["titulo"];
        }
    
        $sql = "INSERT INTO denuncia (titulo, id_denunciante, apelido_denunciante, id_denunciado, apelido_denunciado, motivo, comentario) VALUES (?,?,?,?,?,?,?)";
    
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssssss", $param_titulo, $param_id_denunciante, $param_apelido_denunciante, $param_id_denunciado, $param_apelido_denunciado, $param_motivo, $param_comentario);

            $param_titulo = $titulo;
            $param_id_denunciante = $_SESSION["id"];
            $param_apelido_denunciante = $_SESSION["apelido"];
            $param_id_denunciado = $id_dnc;
            $param_apelido_denunciado = $apelido_denunciado;
            $param_motivo = $motivo_str;
            $param_comentario = $comentario;
    
            if($stmt->execute()){
                echo "<script>alert('Denúncia registrada com sucesso!');</script>";
                echo "<script>location.href='../Usuario_dashboard.php';</script>";
            } else {
                echo "Ops! Algo deu errado. (0)";
            }
    
            $stmt->close();
        }
?>