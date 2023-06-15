<?php
    session_start();

    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    $sql = "SELECT id 
            FROM usuario
            WHERE apelido = (?)";

    $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $param_pesquisa);
        $param_pesquisa = trim($_POST["pesquisa"]);

    if($stmt->execute()){
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            if($_SESSION["id"] == $row["id"]){
                header("location: usuario/perfil/Perfil.php");
            } else {
                header("location: usuario/perfil/Perfil.php?id=".$row['id']."");
            }
            
        }
    }
?>