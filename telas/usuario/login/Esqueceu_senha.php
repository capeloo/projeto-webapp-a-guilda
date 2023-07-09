<?php 
    // Script do esqueceu_senha

    // PHPMailer
        // Import PHPMailer classes into the global namespace
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'C:\xampp\htdocs\projeto-webapp-taverna\PHPMailer\PHPMailer\src\Exception.php';
        require 'C:\xampp\htdocs\projeto-webapp-taverna\PHPMailer\PHPMailer\src\PHPMailer.php';
        require 'C:\xampp\htdocs\projeto-webapp-taverna\PHPMailer\PHPMailer\src\SMTP.php';
        
        //Create an instance;
        $mail = new PHPMailer();

    // Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
    set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
    require_once 'config.php';

    // Inicializa variáveis vazias
    $email = $email_erro = "";

    // Ao receber os dados do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // 1. Validação do E-mail
        // 1.1 Caso o usuário não coloque um e-mail
        if(empty(trim($_POST["email"]))){
            $email_erro = "Por favor coloque um e-mail válido.";
        } else {
            $email = trim($_POST['email']);
        }

        // Após o tratamento e a atribuição dos valores em variáveis
        // Caso não tenha dado erro algum, inicia a requisição ao banco
        if(empty($email_erro)){
            // 2. Guarda a requisição em uma variável
            $sql = "SELECT id, nome, email 
                    FROM usuario 
                    WHERE email = (?)
                    LIMIT 1";
            // 3. Prepara a requisição
            if($stmt = $mysqli->prepare($sql)){
                // 3.1 Valida o input do usuário (Evita injeção de código sql no banco) 
                $stmt->bind_param("s", $param_email);
                $param_email = trim($_POST["email"]);

                // 4. Executa a requisição
                if($stmt->execute()){
                    // 5. Guarda os resultados
                    $stmt_res = $stmt->get_result();
                    // 6. Se existir apenas um registro na tabela no banco, prossiga
                    if($stmt_res->num_rows == 1){
                        // 7. Traz os valores e atribui eles a variáveis
                        $row = $stmt_res->fetch_assoc();
                        $chave = password_hash($row['id'], PASSWORD_DEFAULT);
                        // 8. Nova requisição
                        $sql = "UPDATE usuario 
                                SET recuperar_senha = (?) 
                                WHERE id = (?) 
                                LIMIT 1";
                        // 9. Prepara a requisição
                        if($stmt = $mysqli->prepare($sql)){
                            // 9.1 Valida o input do usuário (Evita injeção de código sql no banco)
                            $stmt->bind_param("si", $chave, $row['id']);
                            // 10. Executa a requisição
                            if($stmt->execute()){
                                // 11. link gerado
                                $link = "http://localhost/projeto-webapp-taverna/telas/usuario/login/Redefinir_senha.php?key=$chave";
                                
                                // 12. Configuração, criação e envio do e-mail
                                try {
                                    // Server settings
                                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
                                    $mail->CharSet = "UTF-8";
                                    $mail->isSMTP();                                            // Send using SMTP
                                    $mail->Host       = 'sandbox.smtp.mailtrap.io';             // Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                    $mail->Username   = 'b227aa0fadf16d';                       // SMTP username
                                    $mail->Password   = 'cc88db698da8fd';                       // SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
                                    $mail->Port       = 2525;                                   // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    // Recipients
                                    $mail->setFrom('caiocapelo@alu.ufc.br', 'Mailer');
                                    $mail->addAddress($row['email'], $row['nome']);             // Add a recipient
                                    $mail->addAddress('ellen@example.com');                     // Name is optional
                                    
                                    // Content
                                    $mail->isHTML(true);                                        // Set email format to HTML
                                    $mail->Subject = 'Redefinição de senha';
                                    $mail->Body    = 'Prezado(a) ' . $row['nome'] . ".<br><br>Você solicitou a alteração da senha.<br><br>
                                                      Para continuar o processo de redefinição de sua senha, clique no link abaixo
                                                      ou cole o endereço no seu navegador.<br><br><a  href='" . $link . "'>$link<a><br><br>Se você não solicitou
                                                      essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até
                                                      que você ative este código.<br><br>";
                                    $mail->AltBody = 'Prezado(a) ' . $row['nome'] . "\n\nVocê solicitou a alteração da senha.\n\nPara continuar o processo de redefinição de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";
                                                                                                                                                                
                                    $mail->send();
                                    // Por algum motivo o código não tá rodando esse script de alert();
                                    echo "<script>alert('Enviado e-mail com instruções para redefinir a senha. Acesse a sua caixa
                                    de e-mail para redefinir a senha!');</script>";
                                    // 13. Redireciona para o login
                                    echo "<script>location.href='Login.php';</script>";

                                }  catch (Exception $e) {
                                    echo "O e-mail não pôde ser enviado. Mailer Error: {$mail->ErrorInfo}";
                                }
                            }
                        }
                    } else {
                        $email_erro = "E-mail inválido.";
                    }
                } else {
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }
            // 14. Fecha a conexão com o banco
            $stmt->close();
            }
        }
    // 15. Fecha a conexão com o banco
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
    <title>Esqueceu a senha</title>
    <link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/standard.css">
    <link rel="stylesheet" href="../../../css/esqueceu_senha.css">
</head>
<body>
    <header class="sticky-top">
        <!-- Barra de navegação -->
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../../index.php"><div id="logo"></div></a>
                <div>
                    <a href="Cadastro.php" id="button-cadastrar"><div>Criar conta</div></a>
                    <a href="Login.php" id="button-entrar"><div>Entrar</div></a>
                </div>
            </div>
        </nav> 
    </header>
    <main>
        <!-- Conteúdo da página -->
        <div class="container-fluid text-center">
            <h1>Encontre sua conta</h1>
            <p>Por favor, preencha o campo para receber um link de redefinição de senha por e-mail.</p>
            <!-- Formulário -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mx-auto p-2">
                    <input type="email" name="email" class="<?php echo (!empty($email_erro)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="E-mail" style="border-radius: 0.2em;">
                    <span class="invalid-feedback"><?php echo $email_erro; ?></span>
                </div>
                <div class="p-4">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <p>&copy; A Guilda. Siga em frente!</p>
            <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>
        </div>
    </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>