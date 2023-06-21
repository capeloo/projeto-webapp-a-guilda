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
      <a class="navbar-brand text-light" href="index.php"><h1 id="logo">A Taverna</h1></a>
      <a href="telas/usuario/login/Login.php"><div id="entrar">Entrar</div></a>
    </div>
  </nav>

<!-- Conteúdo da página -->
    <div class="container-fluid" id="container">
        <div class="row">
            <div class="col text-center ms-5 p-3">
                <h1 class="titulo">A sua plataforma web segura e inclusiva</h1>
                <p class="texto">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non corporis hic officiis soluta doloribus suscipit blanditiis sunt vero quasi optio, asperiores alias ab dolore in sit modi maiores aliquam a. Lorem ipsum dolor, sit amet  consectetur adipisicing elit.
                </p>
                <a href="telas/usuario/login/Login.php"><div id="cadastrar">Comece já sua aventura!</div></a>
            </div>
            <div class="col text-center col-6">
                <img src="assets/images/bussola.jpg" id="bussola">
            </div>
        </div>
    </div>

    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</body>
</html>