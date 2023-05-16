
<?php

//Inicializa variáveis vazias
$apelido_erro = $senha_erro = $login_erro = "";
$apelido = $senha = $id = "";

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados enviados pelo formulário
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $id = $_POST['id'];
    
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "taverna";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Atualizar os dados na tabela 'usuario' ********
    $sql = "UPDATE usuario SET apelido='$apelido' and senha='$senha' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Edição concluída com sucesso');</script>";
        header("Location: Usuario_dashboard.php"); // Redirecionar para a página de dashboard após a edição
        exit;
    } else {
        echo "Erro ao editar usuário: " . $conn->error;
    }

    $conn->close();

}

?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

	<input type="hidden" name="acao" value="edita">
	<div class="mb-3">
		<label>Apelido</label>
		<input type="text" name="apelido" value="<?php echo $apelido; ?>"  class="form-control" required>		
	</div>
	<div class="mb-3">
		<label>Senha</label>
		<input type="password" name="senha" class="form-control" value="<?php echo $senha; ?>" required>
	</div>
    <div class="mb-3">
		<label>Confirmar senha</label>
		<input type="password" name="confirmar_senha" class="form-control" value="<?php echo $senha; ?>" required>
	</div>

	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>

</form>


