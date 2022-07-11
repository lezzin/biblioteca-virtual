<?php

if (isset($_POST['submit'])) 
{
    // Variáveis do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    include_once('config\config.php');

    // Verifica se existe os dados no banco de dados
    $sqlSelect = "SELECT `idCliente`,`nome`, `senha` FROM `cliente` WHERE (`nome` = '$nome') AND (`senha` = $senha)";
    $userVerify = $conexao->query($sqlSelect);

    // Caso exista:
    if ($userVerify->num_rows > 0) 
    {
        $consult = mysqli_fetch_assoc($userVerify);

        // Caso não exista uma sessão, ela é iniciada
        if (session_status() !== PHP_SESSION_ACTIVE) 
        {
            session_start();
        }

        // Armazena os dados do usuário dentro da sessão
        $_SESSION['UsuarioNome'] = $consult['nome'];
        $_SESSION['UsuarioNome'] = $consult['nome'];
        $_SESSION['UsuarioID'] = $consult['idCliente'];

        // Mostra uma mensagem para o usuário e o envia para a página inicial da biblioteca virtual (index.php)
        echo "<script>alert('Logado com sucesso! Seja bem-vindo');</script>";
        header("Location: pages\index.php");
        exit;
    } 
    else 
    {
        // Caso não exista, os dados da sessão são apagados
        unset($_SESSION['UsuarioNome']);
        unset($_SESSION['UsuarioSenha']);
        unset($_SESSION['UsuarioID']);

        header("Location: login.php?erro=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="./public/icons/icon-header.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./public/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">

    <script src="./bootstrap/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        input::placeholder {
            color: #fff;
        }
    </style>

    <title>Login | Bibliozzin</title>
</head>

<body style="font-family: 'Source Sans Pro', sans-serif;">
    <!-- preloader -->
    <div id="preloader">
        <div class="inner">
            <div class="bolas">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- /preloader -->
    <input type="checkbox" id="darkSwitch" style="display: none;">
    <!-- header -->
    <header class="bg-light">
        <noscript>
            <p style="text-align: center;">Ative o javascript antes de logar em sua conta para que as funções do site sejam executadas corretamente!<br>
                Caso o script esteja desativado, a imagem de preloading ficará eternamente na tela! </p>
        </noscript>

        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" tabindex="0" target="_blank" id="github-link" style="cursor:pointer;"><img src="./public/icons/icon-header.png"><span class="p-1">Bibliozzin</span></a>
                <button class="navbar-toggler border-0" style="outline: none;" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center justify-content-end" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link"><label for="darkSwitch" class="pt-2"><i class="fa-solid" id="labelDarkSwitch" tabindex="0" style="cursor: pointer;"></i></label></a>
                        </li>
                    </ul>
            </nav>
        </div>
    </header>
    <!-- /header -->
    <!-- formulario-main -->
    <main>
        <div class="container my-5" style="width:300px;">
            <form method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Seu nome" aria-required="true" required disabled />
                </div>
                <label for="senha">Senha</label>
                <div class="input-group w-100 mb-4">
                    <div class="input-group-prepend w-100">
                        <input type="password" name="senha" class="form-control" id="senha" style="border-radius:4px 0 0 4px !important;" placeholder="Sua senha" aria-required="true" required disabled />
                        <div class="input-group-text rounded-right bg-white border-0 d-flex align-items-center" style="height: 2.25rem !important; margin-top:.9px;"><img width="16" height="16" tabindex="0" id="exibe" src="./public/icons/eye.svg" style="cursor:pointer"></div>
                    </div>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Login</button>
                <a class="text-white btn btn-success mt-2 btn-block" href="pages/register.php">Criar nova conta</a>
            </form>
        </div>
    </main>
    <!-- /formulario-main -->
    <!-- footer -->
    <footer class="bg-light p-2 d-flex flex-column justify-content-center align-items-center">
        <ul class=" nav d-flex justify-content-center align-items-center">
            <li class="nav-item"><a href="https://www.instagram.com/leandroadrian_/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-instagram" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="https://github.com/lezzin" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-github" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="https://www.linkedin.com/in/leandro-adrian/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-linkedin" style="font-size: 1.2rem;"></i></a>
            </li>
        </ul>
        <span class="text-center">&copy Leandro Adrian da Silva, 2022</span>
    </footer>
    <!-- /footer -->
</body>
<script src="./public/js/global.js"></script>
<script src="./public/js/pace.js"></script>
<script src="./public/js/theme.js"></script>

<script type="text/javascript">
    // Evita o autocomplete do google
    $(document).ready(function() {
        setTimeout(function() {
            $('#nome').removeAttr('disabled');
            $('#senha').removeAttr('disabled');
        }, 100);
    });
    // Exibe / oculta a senha
    var $olho = $("#exibe");
    var $senha = $("#senha");
    $olho.on("click keydown", (e) => {
        if (e.which == 13 || e.type == 'click') {
            if ($senha.attr('type') == 'password') {
                $olho.attr("src", "./public/icons/eye-slash.svg");
                $senha.attr("type", "text");
            } else {
                $olho.attr("src", "./public/icons/eye.svg");
                $senha.attr('type', 'password');
            }
        }
    });
</script>

</html>