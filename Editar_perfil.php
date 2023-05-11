<?php
// estabelece conexão com o banco de dados MySQL
require_once "config.php";

// verifica se a conexão foi bem-sucedida
if (!$mysqli) {
  die("Conexão falhou: " . mysqli_connect_error());
}

// obtém as informações do formulário HTML
$apelido = $_POST["apelido"];
$senha = $_POST["senha"];
$confirmar_senha = $_POST["confirmar_senha"];

// verifica se a senha e a confirmação de senha são iguais
if ($senha != $confirmar_senha) {
  echo "As senhas não correspondem.";
} else {
  // cria a consulta SQL para atualizar as informações do usuário
  $sql = "UPDATE usuarios SET senha='$senha' WHERE apelido='$apelido'";

  // executa a consulta SQL
  if (mysqli_query($mysqli, $sql)) {
    echo "As informações do usuário foram atualizadas com sucesso!";
  } else {
    echo "Erro ao atualizar as informações do usuário: " . mysqli_error($mysqli);
  }
}

// fecha a conexão com o banco de dados MySQL
mysqli_close($mysqli);
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

