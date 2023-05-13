<?php

require_once "config.php";

// estabelece conexão com o banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taverna";

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

// verifica se a conexão foi bem-sucedida
if (!$mysqli) {
  die("Conexão falhou: " . mysqli_connect_error());
}

// obtém as informações do formulário HTML 
$apelido = $senha = $confirmar_senha ="";
$apelido_erro = $senha_erro = $login_erro = "";

/*
//Código mais simples que eu tentei fazer (que não deu certo)

// verifica se a senha e a confirmação de senha são iguais
if ($senha != $confirmar_senha) {
  echo "As senhas não correspondem.";
} else {
  // cria a consulta SQL para atualizar as informações do usuário
  $sql = "UPDATE usuario SET senha='$senha' WHERE apelido='$apelido'";

  // executa a consulta SQL
  if (mysqli_query($mysqli, $sql)) {
    echo "As informações do usuário foram atualizadas com sucesso!";
  } else {
    echo "Erro ao atualizar as informações do usuário: " . mysqli_error($mysqli);
  }
}
*/

//mesmo código usado no login (que também não deu certo)

  //Ao receber os dados do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // 1. Validação do apelido
        // 1.1 Caso o usuário não coloque um apelido 
        if(empty(trim($_POST["apelido"]))){
            $apelido_erro = "Por favor, insira o apelido.";
        
        // Passado as validações, atribui o apelido
        } else {
            $apelido = trim($_POST["apelido"]);
        }

        // 2. Validação da senha
        // 2.1 Caso o usuário não coloque uma senha
        if(empty(trim($_POST["senha"]))){
            $senha_erro = "Por favor, insira sua senha.";

        // Passado as validações, atribui a senha
        } else {
            $senha = trim($_POST["senha"]);
        }

        // Após o tratamento e a atribuição dos valores em variáveis
        // Caso não tenha dado erro algum, inicia a requisição ao banco
        if(empty($apelido_erro) && empty($senha_erro)){
            // 1. Guarda a requisição em uma variável
            $sql = "SELECT id, apelido, senha FROM usuario WHERE apelido = (?)";

            // 2. Prepara a requisição
            if($stmt = $mysqli->prepare($sql)){
                // 2.1 Valida o input do usuário (Evita injeção de código sql no banco)
                $stmt->bind_param("s", $param_apelido);
                $param_apelido = trim($_POST["apelido"]);

            // 3. Executa a requisição
                if($stmt->execute()){
                    // 4. Guarda os resultados
                    $stmt_res = $stmt->get_result();
                    // 5. Se existir apenas um registro na tabela no banco, prossiga
                    if($stmt_res->num_rows == 1){
                    // 6. Traz os valores e atribui eles a variáveis
                        if($row = $stmt_res->fetch_assoc()){
                            $id = $row["id"];
                            $apelido = $row["apelido"];
                            $hashed_senha = $row["senha"];
                    // 7. Verificação da senha
                            if(password_verify($senha, $hashed_senha)){
                                // 8. Inicia a sessão e atribui valores as variáveis da sessão
                                session_start();

                                $_SESSION["loggedIn"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["apelido"] = $apelido;

                                // 9. Redireciona para o dashboard
                                header("location: Usuario_dashboard.php");
                            } else {
                                $login_erro = "Apelido ou senha inválidos";
                            }
                        }
                    } else {
                        $login_erro = "Apelido ou senha inválidos.";
                    }
                } else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }
                // 10. Fecha a conexão com o banco
                $stmt->close();
            }
        }
        // 11. Fecha a conexão com o banco (de novo)
        $mysqli->close();
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

