<?php
session_start();

// Caso o usuário não esteja logado, ele é movido para a página de login
if ((!isset($_SESSION['UsuarioNome']) == true) and (!isset($_SESSION['UsuarioSenha']) == true)) 
{
    echo "<script>alert('Você precisa estar logado para acessar a página!');
    window.location = '../login.php';</script>";
    exit;
}

$logado = $_SESSION['UsuarioNome'];

// Botão sair no header apaga a sessão
// Usuário tem que logar novamente
if (isset($_POST['sair'])) 
{
    session_unset();
    session_destroy();
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Leandro Adrian da Silva">
    <meta name="description" content="Página inicial da biblioteca virtual, aqui há o formulário para adição de livros e informações sobre o projeto">

    <link rel="icon" type="image/png" href="../public/icons/icon-header.png" />
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../bootstrap/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Página inicial | Bibliozzin</title>

    <style>
        html {
            scroll-behavior: smooth;
        }

        #nav-bottom-main {
            background: #2525253b;
            border-radius: 15px;
        }

        .scrollToTop {
            font-size: 1.4em;
            position: fixed;
            bottom: 65px;
            right: 45px;
            display: none;
        }
    </style>
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
    <input type="checkbox" id="darkSwitch" name="darkSwitch" style="display:none;">
    <!-- header -->
    <header class="bg-light shadow-sm sticky-top w-100">
        <div class="container">
            <nav class=" navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" id="github-link" tabindex="0"><img src="../public/icons/icon-header.png" loading="lazy"><span class="p-1" style="font-family:'Roboto', sans-serif;">Bibliozzin</span></a>
                <button class="navbar-toggler border-0" style="outline: none;" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center justify-content-end" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="catalog.php">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><label for="darkSwitch" class="pt-2"><i class="fa-solid" id="labelDarkSwitch" tabindex="0" style="cursor: pointer;"></i></label></a>
                        </li>
                        <li class="nav-item align-items-center d-flex">
                            <form method="POST">
                                <button class="btn btn-danger" type="submit" name="sair">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- /header -->

    <!-- principal -->
    <main id="home" class="bg-white d-flex justify-content-center align-items-center flex-column" style="height: 100vh">
        <div class="container-fluid d-flex justify-content-between flex-column">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center text-white">
                        <?php echo "<div class='text-dark'><h1>Olá, $logado</h1><h3>Seja bem-vindo</h3></div>"; ?>
                        <ul class="nav mt-2">
                            <li class="nav-item">
                                <a href="https://www.instagram.com/leandroadrian_/" target="_blank" class="nav-link p-1 text-dark"><i class=" fa-brands fa-instagram" style="font-size: 1.4rem;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="https://github.com/lezzin" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-github" style="font-size: 1.4rem;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.linkedin.com/in/leandro-adrian/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-linkedin" style="font-size: 1.4rem;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="https://api.whatsapp.com/send?phone=35997242338" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-whatsapp" style="font-size: 1.4rem;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="mailto:lezzin.contato@gmail.com" target="_blank" class="nav-link p-1 text-dark"><i class="fa-solid fa-envelope" style="font-size: 1.4rem;"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col d-flex text-center justify-content-center mb-5 mx-5" id="nav-bottom-main">
                    <ul class="nav d-flex text-center justify-content-center p-md-0 p-3">
                        <li class="nav-item"><a href="#" class="nav-link text-dark" id="catalogLink">Ir para o catálogo</a></li>
                        <li class="nav-item"><a href="#form" class="nav-link text-dark">Adicionar um livro</a></li>
                        <li class="nav-item"><a href="#a-ideia" class="nav-link text-dark">De onde surgiu a ideia?</a></li>
                        <li class="nav-item"><a href="#languages" class="nav-link text-dark">Linguagens utilizadas</a></li>
                        <li class="nav-item"><a href="#learned" class="nav-link text-dark">O que aprendi no projeto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <!-- /principal -->

    <!-- informações do catalogo -->
    <section class="mb-5 mt-5 d-flex justify-content-center align-items-center flex-column" id="catalog" style="overflow-y: hidden !important;">
        <h2 class="text-center" data-aos="flip-up">O que você encontrará aqui?</h2>
        <span class="mb-5 text-danger text-center" data-aos="flip-up">Aqui, você encontrará os mais variados gêneros de livros, dos mais variados autores. </span>
        <div class="container mb-2">
            <div class="row">
                <div class="col-md-3 mt-md-0 mt-1 col-6" data-aos="fade-right">
                    <div class="card bg-dark text-white" style="height: 15em;" tabindex="0">
                        <div class="card-header text-center"><b>Programador</b></div>
                        <div class="card-body d-flex justify-content-center align-items-center flex-column text-center">
                            <h5 class="card-title">Livros para programação</h5>
                            <p class="card-text">Aqui há livros de diversas linguagens de programação.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-0 mt-1 col-6" data-aos="fade-up">
                    <div class="card bg-dark text-white" style="height: 15em;" tabindex="0">
                        <div class="card-header text-center"><b>Uma pessoa entediada</b></div>
                        <div class="card-body d-flex justify-content-center align-items-center flex-column text-center">
                            <h5 class="card-title">Livros para entretenimento</h5>
                            <p class="card-text">Há histórias em
                                quadrinhos, livros de ação e aventura.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-0 mt-1 col-6" data-aos="fade-up">
                    <div class=" card bg-dark text-white" style="height: 15em;" tabindex="0">
                        <div class="card-header text-center"><b>Estudioso</b></div>
                        <div class="card-body d-flex justify-content-center align-items-center flex-column text-center">
                            <h5 class="card-title">Livros para estudos</h5>
                            <p class="card-text">Você pode encontrar dicionários e livros
                                didáticos de alta qualidade.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-0 mt-1 col-6" data-aos="fade-left">
                    <div class="card bg-dark text-white" style="height: 15em;" tabindex="0">
                        <div class="card-header text-center"><b>Colecionador</b></div>
                        <div class="card-body d-flex justify-content-center align-items-center flex-column text-center">
                            <h5 class="card-title">Livros exclusivos</h5>
                            <p class="card-text">Também há diversos livros exclusivos e com um ótimo preço.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="../pages/catalog.php" class="btn btn-dark mt-4 mb-5" data-aos="flip-up">Acessar catálogo</a>
    </section>
    <!-- /informações do catalogo -->

    <!-- formulario para adição de livros ao bd -->
    <section class="bg-dark p-5" style="overflow-y: hidden !important;">
        <div class=" text-center text-white mb-5 p-4" data-aos="flip-up">
            <h1 id="form">Formulários</h1>
            <small class="muted">O livro adicionado poderá ser visto na aba <a href="./catalog.php">"catálogo"</a>.</small>
        </div>
        <div class="container">
            <div class="row text-white d-block d-md-flex justify-content-around">
                <div class="col-12 col-md-5" data-aos="fade-right" tabindex="0">
                    <form action="index.php#form" method="POST">
                        <div class="form-title">
                            <h1 class="text-center">Adicionar livro</h1>
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome do livro</label>
                            <input type="text" name="nome" id="nome" class="form-control border-0" placeholder="Nome do livro" spellcheck="false" required>
                        </div>
                        <div class="form-group">
                            <label for="ano">Ano do livro</label>
                            <input type="number" name="ano" id="ano" class="form-control border-0" placeholder="Ano do livro" required>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="preco">Preço</label>
                                    <input type="number" name="preco" id="preco" class="form-control border-0 pl-2" placeholder="Preço do livro" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" name="quantidade" id="quantidade" class="form-control border-0 pl-2" placeholder="Informe a quantidade" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" id="submit" class="btn btn-success">Adicionar</button>
                    </form>
                    <?php
                    if (isset($_POST['submit'])) 
                    {
                        include_once('../config/config.php');

                        // Variáveis
                        $bookName = $_POST['nome'];
                        $bookYear = $_POST['ano'];
                        $bookPrice = $_POST['preco'];
                        $quantity = $_POST['quantidade'];
                        // Comando SQL
                        $selectBookName = "SELECT `nome` FROM `livro` WHERE `nome` = '$bookName'";
                        // Armaneza o resultado do comando na variável $verification - aqui é literalmente como o query do MySQL 
                        $verification = $conexao->query($selectBookName);

                        // Caso o resultado não tenha nenhum dado, exibe a mensagem:
                        if ($verification->num_rows > 0) 
                        {
                            echo "<p>Já existe um livro com esse nome</p>";
                        }
                        else 
                        {
                            // Caso tenha:
                            // Comando SQL novamente
                            $insertBooks = "INSERT INTO livro(nome, ano, preco, quantidade) VALUES ('$bookName', '$bookYear','$bookPrice','$quantity')";
                            //Armazena o resultado na variável result, insere os dados no banco de dados e exibe a mensagem para o usuário entender que o comando aconteceu e foi sucedido
                            $result = $conexao->query($insertBooks);
                            echo "<span class='text-info'>Livro adicionado";
                        }
                    }
                    ?>
                </div>
                <div class="col-12 col-md-4 text-center mt-md-0 mt-5" data-aos="fade-left">
                    <img src="../public/img/books.png" width="400" height="400" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    <!-- /formulario para adição de livros ao bd -->

    <!-- a ideia do projeto -->
    <section id="a-ideia" style="overflow-y:hidden;">
        <div class="container text-center d-flex flex-column justify-content-center align-items-center p-5">
            <h2 class="text-primary pb-2" tabindex="0" data-aos="flip-up">De onde surgiu a ideia?</h2>
            <p data-aos="zoom-out">Bom, a ideia surgiu no dia <span class="text-info">03/07/2022</span>, no início das férias de julho... <br>Desde esse dia, eu sempre me perguntava como um banco de dados "conversava" com uma página web,
                e essa dúvida sempre foi aumentando e aumentando, daí, eu lembrei que eu tinha um projeto sobre o curso de Informática no IFSMG, que seria criar um banco de dados com os conceitos
                aprendidos em aula. Isso foi um grande gancho para eu começar a pensar num tema sobre esse projeto... assim, pensando muito eu cheguei à conclusão de que iria fazer
                uma <b>BIBLIOTECA VIRTUAL</b> <span class="text-info">(aonde você pode adicionar dados, lê-los e removê-los apenas na página web)</span>. De início, eu pensei que seria uma ideia maluca que eu não iria completar, mas no final das contas, até que não foi.<br>
                Graças aos estudos feitos para construir a página, eu aprendi diversos conceitos, como diversas funções do PHP, como criar um formulário de
                login funcional, listar e pesquisar dados a partir do HTML, e o mais importante... finalmente entendi como se conecta um BD com uma página web.<br>Por mais desafiante e díficil que tenha sido construir esse projeto,
                não me arrependo nem um pouco.</p>
        </div>
    </section>
    <!-- /a ideia do projeto -->

    <!-- linguagens utilizadas -->
    <section id="languages" class="bg-dark" style="overflow-y:hidden;">
        <div class="container text-center d-flex flex-column justify-content-center align-items-center p-5">
            <h2 class="text-primary pb-2" data-aos="flip-up">Linguagens utilizadas</h2>
            <div class="row">
                <div class="card-deck m-4">
                    <div class="card text-center" tabindex="0" data-aos="fade-right">
                        <div class="card-body">
                            <h5 class="card-title pb-1">MySQL</h5>
                            <img class="card-img" width="64" height="64" src="../public/icons/sqlLogo.svg" alt="sql logo">
                            <p class="card-text pt-1">O MySQL é um sistema gerenciador de banco de dados relacional de código aberto usado na maioria das aplicações gratuitas para gerir suas bases de dados.</p>
                        </div>
                    </div>
                    <div class="card text-center" tabindex="0" data-aos="fade-up">
                        <div class="card-body">
                            <h5 class="card-title pb-1">Javascript</h5>
                            <img class="card-img" width="64" height="64" src="../public/icons/jsLogo.svg" alt="javascript logo">
                            <p class="card-text pt-1">É uma linguagem de programação que permite a você implementar itens complexos em páginas web. Além dele, utilizei o jQuery, uma biblioteca.</p>
                        </div>
                    </div>
                    <div class="card text-center" tabindex="0" data-aos="fade-left">
                        <div class="card-body">
                            <h5 class="card-title pb-1">PHP</h5>
                            <img class="card-img" width="64" height="64" src="../public/icons/phpLogo.svg" alt="php logo">
                            <p class="card-text pt-1">É uma linguagem de programação que favorece a conexão entre os servidores e a interface do usuário. É ele quem conecta o banco de dados com a página web.</p>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="text-secondary" data-aos="flip-up">Outros itens</h4>
            <div class="row">
                <div class="card-deck m-4">
                    <div class="card text-center" data-aos="fade-right" style="height: 15em;">
                        <div class="card-body">
                            <h5 class="card-title" aria-describedby="#jqueryExp" tabindex="0">jQuery</h5>
                            <p class="card-text" id="jqueryExp">Biblioteca de funções JavaScript que interage com o HTML, que simplifica os scripts interpretados no navegador do cliente.</p>
                        </div>
                        <a class="btn btn-primary" href="https://api.jquery.com/" target="_blank">Documentação</a>
                    </div>
                    <div class="card text-center" data-aos="fade-up" style="height: 15em;">
                        <div class="card-body">
                            <h5 class="card-title" aria-describedby="#bootstrapExp" tabindex="0">Bootstrap</h5>
                            <p class="card-text" id="bootstrapExp">Framework front-end que fornece estruturas de CSS para a criação de sites e aplicações responsivas de forma rápida e simples.</p>
                        </div>
                        <a class="btn btn-primary" href="https://getbootstrap.com/" target="_blank">Documentação</a>
                    </div>
                    <div class="card text-center" data-aos="fade-left" style="height: 15em;">
                        <div class="card-body">
                            <h5 class="card-title" aria-describedby="#aosExp" tabindex="0">AOS</h5>
                            <p class="card-text" id="aosExp">Uma biblioteca de animações, que deixa o site mais interativo para o usuário.</p>
                        </div>
                        <a class="btn btn-primary" href="https://michalsnik.github.io/aos/" target="_blank">Documentação</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /linguagens utilizadas -->

    <!-- o que aprendi -->
    <section id="learned" class="p-5 bg-light" style="overflow-y: hidden;">
        <div class="container text-center d-flex flex-column justify-content-center align-items-center p-5">
            <h2 class="text-primary" data-aos="flip-up">O que aprendi?</h2>
            <div class="card-deck">
                <div class="card" tabindex="0" data-aos="fade-left">
                    <div class="card-header">MySQL</div>
                    <div class="card-body bg-light">
                        <ul class="list-group list-group-flush text-dark" style="font-size: .8rem;">
                            <li class="list-group-item p-1 bg-light">Diversos comandos, como o <samp class="text-primary">DELETE, DROP, ALTER, UPDATE, WHERE(condição)</samp>...</li>
                            <li class="list-group-item p-1 bg-light">Adição de chaves estrangeiras na tabela através de comandos. </li>
                            <li class="list-group-item p-1 bg-light">Operações matemáticas.</li>
                        </ul>
                    </div>
                </div>
                <div class="card" tabindex="0" data-aos="fade-up">
                    <div class="card-header">PHP</div>
                    <div class="card-body bg-light">
                        <ul class="list-group list-group-flush text-dark" style="font-size: .8rem;">
                            <li class="list-group-item p-1 bg-light">Diversas funções, como <samp class="text-warning">str_replace(), number_format(), preg_replace(), date()</samp>...</li>
                            <li class="list-group-item p-1 bg-light">O básico sobre sessões e algumas funções, como <samp class="text-warning">session_start(), session_unset() session_destroy()</samp>...</li>
                            <li class="list-group-item p-1 bg-light">Conexão do BD com a página web com os comandos <samp class="text-warning">new mysqli(), query(), mysqli_fetch_array(), mysqli_fetch_assoc()</samp>...</li>
                        </ul>
                    </div>
                </div>
                <div class="card" tabindex="0" data-aos="fade-right">
                    <div class="card-header">jQuery</div>
                    <div class="card-body bg-light">
                        <ul class="list-group list-group-flush text-dark" style="font-size: .8rem;">
                            <li class="list-group-item p-1 bg-light">Diversos comandos, como os event listeners (load, ready, click e keydown), animações fadeIn e fadeOut.</li>
                            <li class="list-group-item p-1 bg-light">Criação e uso das variáveis com $ no início, como no PHP.</li>
                            <li class="list-group-item p-1 bg-light">Funções como <samp class="text-warning">attr(), prop(), hasClass()</samp>.</li>
                            <li class="list-group-item p-1 bg-light">Melhorei bastante a minha lógica de programação também.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="pt-2" data-aos="flip-down">Em resumo, melhorei minha lógica em jQuery/javascript<br>
                Conheci e aprendi diversas funções do PHP<br>
                Aprendi a utilizar comandos simples de SQL e me familiarizei com o MySQL.
            </p>
        </div>
    </section>
    <!-- /o que aprendi -->

    <!-- footer -->
    <footer class="bg-light shadow-lg p-2 d-flex flex-column justify-content-center align-items-center">
        <ul class="nav d-flex justify-content-center align-items-center">
            <li class="nav-item">
                <a href="#home" class="nav-link">Início</a>
            </li>
            <li class=" nav-item">
                <a href="../pages/catalog.php" class="nav-link">Catálogo</a>
            </li>
        </ul>
        <ul class=" nav d-flex justify-content-center align-items-center">
            <li class="nav-item"><a href="https://www.instagram.com/leandroadrian_/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-instagram" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="https://github.com/lezzin" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-github" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="https://www.linkedin.com/in/leandro-adrian/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-linkedin" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="https://api.whatsapp.com/send?phone=35997242338" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i></a>
            </li>
            <li class="nav-item"><a href="mailto:lezzin.contato@gmail.com" target="_blank" class="nav-link p-1 text-dark"><i class="fa-solid fa-envelope" style="font-size: 1.2rem;"></i></a>
            </li>
        </ul>
        <a href="https://github.com/lezzin/" target="_blank" class="text-dark">&copy Leandro Adrian da Silva, 2022</a>
        <small class="text-danger">Todos os direitos reservados</small>
    </footer>
    <!-- /footer -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-arrow-up"></i></a>
</body>
<script src="../public/js/global.js"></script>
<script src="../public/js/pace.js"></script>
<script src="../public/js/theme.js"></script>
<script>
    // Inicializa o script da animação da página
    AOS.init();

    // Função da seta que volta a página para seu início
    $(document).ready(() => {
        $(window).scroll(() => {
            if ($(this).scrollTop() > 100) {
                // Se a altura da página for maior que 100, a seta aparece
                $('.scrollToTop').fadeIn();
            } else {
                // Senão, ela some
                $('.scrollToTop').fadeOut();
            }
        });
        $('.scrollToTop').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
        // fadeIn e FadeOut são funções do jquery, são como o opacity 0 e opacity 1 com o transition
    });

    $("#catalogLink").click(() => {
        if (confirm("Você será dimensionado para uma página na mesma janela")) {
            $("#catalogLink").attr("href", "catalog.php");
        } else {}
    });
</script>

</html>