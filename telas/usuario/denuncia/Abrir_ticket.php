<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Denúncia</title>
    <link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">
    <!-- Chamando as folhas de estilo do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/standard.css" rel="stylesheet">
    <link href="../../../css/abrir_ticket.css" rel="stylesheet">
</head>
<body>
    <header class="sticky-top" id="h">
        <a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
        <nav>
            <div class='container-fluid'>
                <div>
                    <form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>
                        <div style='display:flex;'>
                            <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
                        </div>
                    </form>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
                            <a class="dropdown-item" href="../../mesa/Minhas_mesas.php">Minhas mesas</a>
                            <a class="dropdown-item" href="../../mesa/Cadastro_mesa.php">Cadastrar mesa</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>
                        <div class="dropdown-menu dropdown-menu-lg-end">
                            <a class="dropdown-item" href="../../noticias/Lista_de_noticias.php">Feed de notícias</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>
                        <div class="dropdown-menu dropdown-menu-lg-end">
                            <a class="dropdown-item" href="../perfil/Perfil.php">Meu perfil</a>
                            <a class="dropdown-item" href="../perfil/Editar_perfil.php">Editar perfil</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="../login/logout.php">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- Conteúdo da página -->
        <div class="container-fluid text-center">
            <h1>Ticket de Denúncia</h1>
            <!-- Formulário -->
            <form action="denunciar.php?id=<?php echo $_GET["id"]?>" method="post">
                <div class="container-fluid" style="width: 100vw; display:flex; flex-direction: column;">
                    <div id="content-header">
                        <h1 style="font-size: 2em;">Por que deseja denunciar esse usuário?</h1>
                        <p style="font-size: 1.2em;">Lamentamos que você precise passar por esse tipo de situação, ajudaremos da melhor forma possível.</p>
                    </div>
                    <div id="content">
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
                    <div id="content-2">
                        <div class="input-group mx-auto p-2" style="width: 62.7em;">
                            <input type="text" name="titulo" class="form-control" placeholder="Título">
                        </div>
                        <div>
                            <textarea name="comentario" placeholder="Escreva sua denúncia aqui!" class="form-control mb-2" cols="30" row="10" style="width: 61.8em; height: 200px; margin: auto;"></textarea>
                        </div> 
                        <div class="p-4 text-center">
                            <button class="btn btn-success" style="width: 120px;" type="submit">Enviar</button>
                        </div>  
                    </div>     
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div style="padding: 0px; padding-left: 1em; padding-right: 1em; height: 35px;">
            <p style="margin-top: 1em;">&copy; A Guilda. Siga em frente!</p>
            <p style="margin-top: 1em;">Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>
        </div>
    .</footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>