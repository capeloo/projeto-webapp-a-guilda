<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="shortcut icon" href="assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
  <!-- Barra de navegação -->
  <nav class="navbar sticky-top" id="header">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><div id="logo">A Taverna</div></a>
      <a href="telas/usuario/login/Login.php"><div id="entrar">Entrar</div></a>
    </div>
  </nav> 

<!-- Conteúdo da página -->
    <div class="row w-100" style="height: 35em;">
      <div class="col" id="col1">
        <h1 id="titulo">O seu hub de RPG, seguro e inclusivo.</h1>
        <p id="texto">
          Crie ou entre em mesas, participe de conteúdos coletivos, encontre jogadores e personalize seu perfil em uma plataforma direto do seu navegador.
        </p>
        <a href="telas/usuario/login/Cadastro.php">
          <div id="cadastrar">
            Comece já sua aventura!
          </div>
        </a>
      </div>
      <div class="col" id="col2" style="background: url(assets/images/bussola.jpg); background-size: cover;"></div>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</body>
</html>