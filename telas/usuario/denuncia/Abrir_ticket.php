<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Denúncia</title>
    <link rel="shortcut icon" href="../../../assets/fav.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegação -->
    <nav class="navbar bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="../Usuario_dashboard.php">Taverna</a>
            <form class='form-inline' action='../../pesquisar.php' method='post'>
                <div style='display:flex;'>
                    <input class='form-control mr-sm-2' type='search' placeholder='Apelido' name='pesquisa'>
                    <button class='btn btn-outline-light my-2 ms-2 my-sm-0' type='submit'>Pesquisar</button>
                </div>
            </form>
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
                            <strong>Perfil</strong>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Perfil.php">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Editar_perfil.php">Editar perfil</a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <strong>Mesas</strong>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Cadastro_mesa.php">Cadastro de mesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Conteúdo da página -->
    <div class="container-fluid text-center mt-3">
        <h1 class="p-3">Ticket de Denúncia</h1>
        <!-- Formulário -->
        <form action="denunciar.php?id=<?php echo $_GET["id"]?>" method="post">
            <div>
                <div class="input-group mx-auto p-2" style="width: 400px;">
                    <span class="input-group-text" style="font-size: 1.2em;">Título</span>
                    <input type="text" name="titulo" class="form-control">
                </div>
            </div> 
            <div class="container-fluid" style="width: 90%; display:flex;">
                <div>
                    <h1 class="text-start p-3" style="font-size: 2em;">Por que deseja denunciar esse usuário?</h1>
                    <div class="form-check" style="display: flex; font-size: 1.2em;">
                        <input type="checkbox" name="cb1" id="cb1" class="form-check-input ms-0" value="O usuário praticou bullying, assédio ou difamação">
                        <label for="cb1" class="form-check-label ms-2">O usuário praticou bullying, assédio ou difamação.</label>
                    </div>
                    <div class="form-check" style="display: flex; font-size: 1.2em;">
                        <input type="checkbox" name="cb2" id="cb2" class="form-check-input ms-0" value="O usuário expôs informações sensíveis, confidenciais">
                        <label for="cb2" class="form-check-label ms-2">O usuário expôs informações sensíveis, confidenciais.</label>
                    </div>
                    <div class="form-check" style="display: flex; font-size: 1.2em;">
                        <input type="checkbox" name="cb3" id="cb3" class="form-check-input ms-0" value="O usuário incita o ódio contra minorias">
                        <label for="cb3" class="form-check-label ms-2">O usuário incita o ódio contra minorias.</label>
                    </div>
                    <div class="form-check" style="display: flex; font-size: 1.2em;">
                        <input type="checkbox" name="cb4" id="cb4" class="form-check-input ms-0" value="O usuário possui um conteúdo violento/explícito">
                        <label for="cb4" class="form-check-label ms-2">O usuário possui um conteúdo violento/explícito.</label>
                    </div>
                    <div class="form-check" style="display: flex; font-size: 1.2em;">
                        <input type="checkbox" name="cb5" id="cb5" class="form-check-input ms-0" value="Outro">
                        <label for="cb5" class="form-check-label ms-2">Outro:</label>
                    </div>
                </div>
            <div>
                <h1 class="text-start p-3 ms-4 text-center" style="font-size: 2em;">Comentário</h1>
                <textarea name="comentario" placeholder="Escreva sua denúncia aqui!" class="form-control ms-5 mb-5" cols="30" row="10" style="width: 500px; height: 200px;"></textarea>
            </div> 
            </div>
            <div class="p-4 text-center">
                <button class="btn btn-success" style="width: 120px;" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>