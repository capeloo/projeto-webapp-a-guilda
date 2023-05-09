<?php

/*
session_start();
 include "config.php";
 if(isset($_POST['edita']))
 {
    $id=$_SESSION['id'];
    $apelido=$_POST['apelido'];
    
    $senha=$_POST['senha'];
    $select= "select * from users where id='$id'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
    if($res === $id)
    {
   
       $update = "update users set apelido='$apelido',senha='$senha' where id='$id'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/ /*
           header('location:Usuario_dashboard.php');
       }
       else
       {
           /*sorry your profile is not update*//*
           header('Editar_perfil.php');
       }
    }
    else
    {
        /*sorry your id is not match*//*
        header('location:Editar_perfil.php');
    }
 }

*/

/*
case 'editar':
        $apelido = $_POST["apelido"];
        
        $senha = md5($_POST["senha"]);
        

        $sql = "UPDATE usuarios SET
                    apelido='{$apelido}',
                    
                    senha='{$senha}',
                    
                WHERE 
                    id = ".$_REQUEST["id"];      

        $res = $mysqli->query($sql);

        if ($res==true) {
            print "<script>alert('Editado com sucesso')</script>";
            print "<script>location.href='?page=listar'</script>";
        }else {
            print "<script>alert('Não foi possível editar')</script>";
            print "<script>location.href='?page=listar'</script>";
        }
        break;



*/
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
	<input type="hidden" name="acao" value="edita">
	<div class="mb-3">
		<label>Apelido</label>
		<input type="text" name="apelido" value="<?php echo $apelido; ?>" class="form-control <?php echo (!empty($apelido_erro)) ? 'is-invalid' : ''; ?>"">		
	</div>
	<div class="mb-3">
		<label>Senha</label>
		<input type="password" name="senha" class="form-control <?php echo (!empty($senha_erro)) ? 'is-invalid' : ''; ?>"" required>
	</div>
    <div class="mb-3">
		<label>Confirmar senha</label>
		<input type="password" name="confirmar_senha" class="form-control <?php echo (!empty($confirmar_senha_erro)) ? 'is-invalid' : ''; ?>"" required>
	</div>

	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>

</form>

