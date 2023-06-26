<?php
    //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
  session_start();

  //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
  set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
  require_once 'config.php';

  $sql = "SELECT id, anuncio
            FROM mesa
            WHERE id = (?)";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        $param_id = $_GET['id'];

        //Executando a requisição ao banco
        if($stmt->execute()){
            $stmt_res = $stmt->get_result();
      
            if($stmt_res->num_rows == 1){
                $row = $stmt_res->fetch_assoc();
            } else {
            echo "Ops! Algo deu errado. (0)";
            }
        }
    }

    if($row["anuncio"] == 1){
        $sql = "UPDATE mesa
                SET anuncio = 0
                WHERE id = (?)
                ";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            $param_id = $_GET['id'];

        //Executando a requisição ao banco
        if($stmt->execute()){
            echo "<script>alert('Anúncio retirado com sucesso!');</script>";
            echo "<script>location.href='../usuario/Usuario_dashboard.php';</script>";
      
        } else {
            echo "Ops! Algo deu errado. (0)";
        }
      
        // Fecha a conexão com o banco
        $stmt->close();
        }
    } else if($row["anuncio"] == 0){
        echo "<script>alert('Esta mesa não está sendo anunciada no momento!');</script>";
        echo "<script>location.href='../usuario/Usuario_dashboard.php';</script>";
    }

  
?>