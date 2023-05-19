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
</head>
<body class="bg-light">
  <!-- Barra de navegação -->
  <nav class="navbar bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="index.php">Taverna</a>
      <!-- Offcanvas -->
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link" href="telas\usuario\login\Login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="telas\usuario\login\Cadastro.php">Criar conta</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Página inicial</a>
              </li>
            </ul>
          </div>
        </div>
    </div>
  </nav>

<!-- Conteúdo da página -->
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center ms-5 p-3">
                <h1 class="display-1">Taverna</h1>
                <h3 class="h1">A sua plataforma web segura e inclusiva</h3>
                <p class="text-dark text-center mt-4">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non corporis hic officiis soluta doloribus suscipit blanditiis sunt vero quasi optio, asperiores alias ab dolore in sit modi maiores aliquam a. Lorem ipsum dolor, sit amet  consectetur adipisicing elit. Libero minus ea quos excepturi earum voluptatum dolor, nostrum nulla numquam dolorem inventore blanditiis vitae velit facere magnam porro quia consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi vel nesciunt numquam debitis, minima inventore fugiat consequatur atque qui, corrupti itaque minus repellendus id alias labore suscipit sapiente fugit sed.
            </div>
            <div class="col text-center mt-5 col-6">
                <img src="assets/asset-01.png">
            </div>
        </div>
    </div>

    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</body>
</html>