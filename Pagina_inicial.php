<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-bg-info">
<nav class="navbar bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="Pagina_inicial.php">Página Inicial</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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
    <div class="container text-left p-3" style="width: 500px; height: 100vh">
        <div>
        <h1>
            Taverna
        </h1>
        <h3>
            A sua plataforma web segura e inclusiva
        </h3>
        <p class="text-light">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non corporis hic officiis soluta doloribus suscipit blanditiis sunt vero quasi optio, asperiores alias ab dolore in sit modi maiores aliquam a. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero minus ea quos excepturi earum voluptatum dolor, nostrum nulla numquam dolorem inventore blanditiis vitae velit facere magnam porro quia consequatur! Est! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur, omnis in. Accusantium excepturi a impedit recusandae esse illo voluptates! Explicabo quas debitis vel perferendis voluptate, ut repudiandae tempora adipisci consectetur? Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</body>
</html>