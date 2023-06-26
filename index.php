<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="shortcut icon" href="assets/images/compass.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/media-queries.css">
</head>
<body>
  <header class="sticky-top">
    <!-- Barra de navegação -->
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php" id="logo"><div>A Taverna</div></a>
        <div>
          <a href="telas/usuario/login/Cadastro.php" id="button-cadastrar"><div>Criar conta</div></a>
          <a href="telas/usuario/login/Login.php" id="button-entrar"><div>Entrar</div></a>
        </div>
      </div>
    </nav> 
  </header>
<!-- Conteúdo da página -->
  <main>
    <section>
      <div>
        <div>
          <h1>O seu hub de RPG seguro e inclusivo.</h1>
          <p>
            Crie ou entre em mesas, participe de conteúdos coletivos, encontre jogadores e personalize seu perfil em uma plataforma direto do seu navegador.
          </p>
          <a href="telas/usuario/login/Cadastro.php">
            <div>
              Comece já sua aventura!
            </div>
          </a>
        </div>
        <div id="imagem"></div>
    </section>
  </main>
  <footer>
    <div class="container-fluid">
      <p>&copy; A Guilda. Siga em frente!</p>
      <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="assets/Ellipse.svg"></a></p>
    </div>
  </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>