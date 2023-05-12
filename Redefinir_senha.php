<?php
require_once "config.php";

$chv = isset($_GET["key"]) ? $_GET["key"] : "";

$nova_senha = $confirmar_nova_senha = "";
$nova_senha_erro = $confirmar_nova_senha_erro = $link_erro = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_nova_senha = $_POST['confirmar_nova_senha'];

    $sql = "SELECT id
            FROM usuario 
            WHERE recuperar_senha = (?)
            LIMIT 1";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $chave);
        $chave = $_POST['key'];

        if ($stmt->execute()) {
            $stmt_res = $stmt->get_result();
            if ($stmt_res->num_rows == 1) {
                $row = $stmt_res->fetch_assoc();
                $id = $row['id'];

                    $sql = "UPDATE usuario
                            SET senha = (?),
                            recuperar_senha = (?)
                            WHERE id = (?)
                            LIMIT 1";

                    if ($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("ssi", $param_nova_senha, $param_recuperar_senha, $id);
                        $param_nova_senha = $nova_senha;
                        $param_recuperar_senha = "NULL";
                        if ($stmt->execute()) {
                            echo "<script>alert('Redefinição realizada com sucesso!');</script>";

                        } else {
                            echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                        }

                        $stmt->close();
                    }
                } else {
                    echo "Link inválido! Tente novamente.";
                    header("location: Esqueceu_senha.php");
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            } 
        }
        $mysqli->close();
    } 
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir a senha</title>
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="Pagina_inicial.php">Taverna</a>
            <!-- Offcanvas -->
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="Login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Cadastro.php">Criar conta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Pagina_inicial.php">Página inicial</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-4">
        <h1 class="display-4 p-3">Redefinir a senha</h1>
        <!-- Formulário -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="key" value="<?php echo $chv ?>">
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Nova senha</span>
                <input type="password" name="nova_senha"
                    class="form-control <?php echo (!empty($nova_senha_erro)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $nova_senha; ?>">
                <span class="invalid-feedback"><?php echo $nova_senha_erro; ?></span>
            </div>
            <div class="input-group mx-auto p-2" style="width: 300px;">
                <span class="input-group-text">Confirmar nova senha</span>
                <input type="password" name="confirmar_nova_senha"
                    class="form-control <?php echo (!empty($confirmar_nova_senha_erro)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirmar_nova_senha; ?>">
                <span class="invalid-feedback"><?php echo $confirmar_nova_senha_erro; ?></span>
            </div>
            <div class="p-4">
                <button class="btn btn-success" style="width: 100px;" type="submit">Confirmar</button> 
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>