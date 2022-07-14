<?php

include_once('../config/config.php');

// Inicia a sessão
session_start();

if ((!isset($_SESSION['UsuarioNome']) == true) and (!isset($_SESSION['UsuarioSenha']) == true)) {
    echo "<script>alert('Você precisa estar logado para acessar a página!');
    window.location = '../login.php';</script>";
    exit;
}

$user = $_SESSION['UsuarioNome'];

$viewBooks = "SELECT * FROM livro ORDER BY nome ASC";
$result = $conexao->query($viewBooks);

// Funções auxiliares
// Quando o usuário atualizar a página, os valores dos inputs não resetarão, como exemplo na linha 213
function rentBook()
{
    if (isset($_GET['calcularPrecoAluguel'])) {
        $rentBook = $_GET['nomeLivroAlugado'];
        echo $rentBook;
    } else {
        echo "";
    }
}
function rentNumber()
{
    if (isset($_GET['calcularPrecoAluguel'])) {
        $rentDays = $_GET['dias'];
        echo $rentDays;
    } else {
        echo "";
    }
}

function purchaseBook()
{
    if (isset($_GET['calcularCompra'])) {
        $purchaseBook = $_GET['nomeLivroComprado'];
        echo $purchaseBook;
    } else {
        echo "";
    }
}

function quantityBook()
{
    if (isset($_GET['quantidadeLivro'])) {
        $quantidade = $_GET['quantidadeLivro'];
        echo $quantidade;
    } else {
        echo "";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catálogo da biblioteca - onde ficam os livros e a área de vendas/empréstimos">
    <meta name="author" content="Leandro Adrian da Silva">

    <link rel="icon" type="image/png" href="../public/icons/icon-header.png" />
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="../bootstrap/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <title>Catálogo | Bibliozzin</title>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .scrollToTop {
            font-size: 1.4em;
            position: fixed;
            bottom: 65px;
            right: 45px;
            display: none;
        }

        #showMoreInformations,
        #showPrice {
            border-color: transparent !important;
        }

        .gradient-text {
            background: linear-gradient(270deg, #b527cf, #3bd9d9);
            font-weight: bold;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        a.gradient-text:hover {
            background: linear-gradient(270deg, #f958ef, #5df9f9);
            font-weight: bold;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        #search-area {
            background: rgb(34, 149, 243) !important;
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
    <!-- Esse input checkbox é quem faz o tema da página ser mudado, não aparece para o usuário mas seu label na linha 134 faz com que ele seja mudado -->
    <input type="checkbox" id="darkSwitch" style="display: none;">

    <!-- header -->
    <header class="backdrop-filter shadow-sm sticky-top w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" tabindex="0" target="_blank" id="github-link"><img src="../public/icons/icon-header.png" loading="lazy"><span class="p-1" style="font-family:'Roboto', sans-serif;">Bibliozzin</span></a>
                <button class="navbar-toggler border-0" style="outline: none;" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center justify-content-end font-weight-bold" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="form-addBook">Adicionar livro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#catalog">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="catalog-home">Voltar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><label for="darkSwitch" class="pt-2"><i class="fa-solid" id="labelDarkSwitch" tabindex="0" style="cursor: pointer;"></i></label></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- /header -->

    <!-- pesquisa -->
    <section id="search-area">
        <div class="container">
            <div class="row pt-3 d-flex justify-content-center">
                <div class="col-md-7 col-12">
                    <form action="search.php" method="POST">
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <input class="form-control border-dark" name="search" id="search" type="search" placeholder="Pesquisar" aria-label="Search" spellcheck="false">
                            <button type="submit" class="btn btn-success ml-1" name="pesquisar" id="pesquisar">ir</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#alugarLivro">Alugar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#comprarLivro">Comprar</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /pesquisa -->

    <!-- catalogo -->
    <div class="container mt-4 mb-5">
        <?php echo "<h3 class='text-center pb-4'>Olá $user, esse é o nosso catálogo.</h3>"; ?>
        <div class="row d-flex justify-content-center align-items-center">
            <?php

            if ($result->num_rows == 0) {
                echo "<div class='my-5 text-center'>
                        <h3 class='text-danger p-1' id='nothingToShow'>Não há nada para mostrar aqui</h3><br>
                        <h4>Para aparecer algo no catálogo, adicione um livro por aqui: <a href='./index.php#form'>ir para o formulário</a></h4>
                    </div>";
            } else {
                while ($data = mysqli_fetch_array($result)) { {
                        if ($data['quantidade'] == 0) {
                            echo "
                                <div class='card m-1 rounded' style='width: 16rem; height: 16rem;' data-aos='fade-up'>
                                    <div class='card-body d-flex justify-content-center align-items-center flex-column text-center'>
                                        <h5 class='card-title' tabindex='0'>" . $data['nome'] . "</h5>
                                        Ano de lançamento: "  . $data['ano'] . "<br>
                                        Preço do livro: R$" . str_replace('.', ',', $data['preco']) . "<br>
                                        <p class='text-danger font-weight-bold'>Indisponível</p>                        
                                        <div class='d-flex justify-content-around mt-1 w-50'>
                                            <a href='../config/delete.php?id=$data[idLivro]'><img src='../public/icons/trash-can-solid.svg' width='16' height='16' loading='lazy'></a>
                                            <a href='edit.php?id=$data[idLivro]'><img src='../public/icons/pencil.svg' width='16' height='16' loading='lazy'></a>
                                        </div>
                                    </div>
                                </div>";
                        } else {
                            echo "
                                <div class='card m-1 rounded' style='width: 16rem; height: 16rem;' data-aos='fade-up'>
                                    <div class='card-body d-flex justify-content-center align-items-center flex-column text-center'>
                                        <h5 class='card-title' tabindex='0'>" . $data['nome'] . "</h5>
                                        Ano de lançamento: " . $data['ano'] . "<br>
                                        Preço do livro: R$" . str_replace('.', ',', $data['preco']) . "<br>
                                        Disponíveis: " . $data['quantidade'] . "<br>
                                        <div class='btn-group pt-1 pb-1' role='group'>
                                            <a href='#alugarLivro' class='btn btn-secondary'>Alugar</a>
                                            <a href='#comprarLivro' class='btn btn-secondary'>Comprar</a>
                                        </div>
                                        <div class='d-flex justify-content-around mt-1 w-50'>
                                            <a href='../config/delete.php?id=$data[idLivro]'><img src='../public/icons/trash-can-solid.svg' width='16' height='16' loading='lazy'></a>
                                            <a href='edit.php?id=$data[idLivro]'><img src='../public/icons/pencil.svg' width='16' height='16' loading='lazy'></a>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <!-- /catalogo -->

    <!-- aluguel e venda de livros -->
    <section class="bg-dark p-5" id="home" style="overflow-y: hidden;">
        <div class="container rounded p-3">
            <div class="row pt-5" id="alugarLivro">

                <!-- formulario do aluguel de livros -->
                <div class="col" data-aos="fade-right">
                    <form class="px-4 py-3" action="./catalog.php#alugarLivro" method="GET">
                        <h1 class="text-center mb-5 gradient-text">Alugar um livro</h1>
                        <div class="form-group">
                            <label for="nomeLivro" class="text-light">Nome do livro</label>
                            <input type="text" name="nomeLivroAlugado" class="form-control" id="nomeLivroAlugado" value="<?php rentBook(); ?>" placeholder=" Nome do livro" required>
                        </div>
                        <div class="form-group">
                            <label for="dias" class="text-light">Insira quantos dias o livro será alugado.</label>
                            <small id="dayHelp">1 dia = R$4,00</small>
                            <input type="number" class="form-control" id="dias" name="dias" placeholder="Apenas o número... ex: 2" value="<?php rentNumber(); ?>" aria-describedby="dayHelp" required>
                            <?php
                            if (isset($_GET['calcularPrecoAluguel'])) {
                                $rentBook = $_GET['nomeLivroAlugado'];
                                $days = $_GET['dias'];

                                $selectBookToRent = "SELECT idLivro, quantidade FROM livro WHERE nome LIKE '$rentBook'";
                                $result = $conexao->query($selectBookToRent);

                                $rentPrice = number_format((4 * $days), 2, ',', '.');
                                if (mysqli_errno($conexao)) {
                                    echo "<small class='text-danger font-weight-bold' id='nomeInvalidoAluguel'>Nome inválido, retire o caractere</small>";
                                } else {
                                    $bookIDDatas = mysqli_fetch_assoc($result);
                                    if (mysqli_num_rows($result) == 0) {
                                        echo "<small class='text-danger font-weight-bold' id='nomeErradoAluguel'>Não há livro com esse nome... <br>dica: insira o nome do livro exatamente como ditado acima</small>";
                                    } else if ($bookIDDatas['quantidade'] == 0) {
                                        echo "<small class='text-danger font-weight-bold' id='semEstoqueAluguel'>Não temos esse livro no estoque :/</small>";
                                    } else {
                                        $bookID = $bookIDDatas['idLivro'];
                                        echo "<small class='text-light font-weight-bold'>O livro custará R$<span id='rentPrice'>" . $rentPrice . "</span></small>";
                                        echo "<input type='hidden' name='bookID' id='bookId' value='" . $bookID . "'>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="d-flex">
                            <button type="submit" name="calcularPrecoAluguel" id="calcularPrecoAluguel" class="btn btn-primary">Calcular preço</button>
                            <button type="button" id="btnAluguel" class="btn btn-success ml-1" data-toggle="modal" data-target="#modal-form" disabled>Alugar</button>
                        </div>
                    </form>
                </div>
                <div class="col text-center" data-aos="fade-left">
                    <img src="../public/img/background.png" width="400" height="400" loading="lazy">
                </div>
            </div>
            <!-- /formulario do aluguel de livros -->

            <!-- formulário da compra de livros -->
            <div class="row pt-5" id="comprarLivro" data-aos="fade-left">
                <div class="col d-md-flex align-items-center justify-content-center d-none" data-aos="fade-right">
                    <img src="../public/img/background.png" width="400" height="400" loading="lazy">
                </div>
                <div class="col" data-aos="fade-left">
                    <h3 class="text-center gradient-text">Comprando o livro, você terá 10% de desconto</h3>
                    <form class="px-4 py-3" action="./catalog.php#comprarLivro" method="GET">
                        <h1 class="text-center gradient-text mb-5">Comprar um livro</h1>
                        <div class="form-group">
                            <label for="nomeLivroComprado" class="text-light">Nome do livro</label>
                            <input type="text" class="form-control" name="nomeLivroComprado" id="nomeLivroComprado" placeholder="Nome do livro" required value="<?php purchaseBook(); ?>">
                        </div>
                        <div class=" form-group">
                            <label for="quantidadeLivro" class="text-light">Quantidade</label>
                            <input type="number" class="form-control" name="quantidadeLivro" id="quantidadeLivro" placeholder="Quantidade" required value="<?php quantityBook(); ?>">
                            <?php
                            if (isset($_GET['calcularCompra'])) {
                                $purchaseBookName = $_GET['nomeLivroComprado'];
                                $quantity = $_GET['quantidadeLivro'];
                                $purchaseInputs = "SELECT `idLivro`,`preco`,`quantidade` FROM livro WHERE nome LIKE '$purchaseBookName'";
                                $resultSearch = $conexao->query($purchaseInputs);
                                if (mysqli_errno($conexao)) {
                                    echo "<small class='text-danger font-weight-bold' id='nomeInvalidoCompra'>Nome inválido, retire o caractere</small>";
                                } else {
                                    $data = mysqli_fetch_array($resultSearch);
                                    if ($resultSearch->num_rows == 0) {
                                        echo "<small class='text-danger font-weight-bold' id='nomeErradoCompra'>Não há livro com esse nome... <br>dica: insira o nome do livro exatamente como ditado acima</small>";
                                    } else if ($data['quantidade'] < $quantity or $quantity == 0) {
                                        echo "<small class='text-danger font-weight-bold' id='semEstoqueCompra'>Não há essa quantidade no estoque</small>";
                                    } else {
                                        $bookID = $data['idLivro'];
                                        $price = number_format(($data['preco'] * $quantity - ($data['preco'] * $quantity * 10 / 100)), 2, ',', '.');
                                        echo "<small class='text-light font-weight-bold'>O livro custará R$<span id='price'>" . $price . "</span></small>";
                                        echo "<input type='hidden' name='bookPurchasedID' id='bookPurchasedID' value='" . $bookID . "'>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class=" d-flex justify-content-end">
                            <button type="button" class="btn btn-success mr-1" id="btnCompra" data-toggle="modal" data-target="#modal-form" disabled>Comprar</button>
                            <button type="submit" name="calcularCompra" id="btnCalculo" class="btn btn-primary">Calcular preço</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- formulário da compra de livros -->
        </div>
    </section>
    <!-- aluguel e venda de livros -->

    <!-- footer -->
    <footer class="bg-dark p-2 d-flex flex-column justify-content-center align-items-center shadow-sm">
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
        <a href="https://github.com/lezzin/" target="_blank" class="text-white">&copy Leandro Adrian da Silva, 2022</a>
        <small class="text-white">Todos os direitos reservados</small>
    </footer>
    <!-- /footer -->

    <!-- modal  -->
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modal-title">Formulário de compra/aluguel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-submit">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-dark">Email de usuário</label>
                            <input type="email" class="form-control" name="email-usuario" id="email" placeholder="Seu email" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="senha" class="col-form-label text-dark">Senha</label>
                            <input type="password" class="form-control" name="senha-usuario" id="senha" placeholder="Sua senha" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="cpf" class="col-form-label text-dark">CPF</label>
                            <input type="number" class="form-control" name="cpf-usuario" id="cpf" placeholder="Seu CPF" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo-de-compra" class="col-form-label text-dark">Aluguel ou compra?</label>
                            <select class="form-control bg-transparent text-dark" name="tipo-de-compra" id="tipo-de-compra" required>
                                <option class="text-secondary" selected>---</option>
                                <option class="text-secondary" value="Aluguel">Aluguel</option>
                                <option class="text-secondary" value="Compra">Compra</option>
                            </select>
                            <!-- inputs de ajuda para preencher o banco de dados -->
                            <input type="text" class="form-control font-weight-normal" name="precoConta" id="showPrice" style="display: none;" readonly>
                            <input type="text" class="form-control font-weight-normal" name="additional" id="showMoreInformations" style="display: none;" readonly>
                            <input type="hidden" class="form-control font-weight-normal" name="livro" id="auxiliarInput">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" name="enviarForm" id="btn-submit">Finalizar pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal -->

    <div class="scrollToTop" tabindex="0">
        <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
</body>

<script type="text/javascript">
    AOS.init();

    $(document).ready(() => {
        // Evita o autocomplete do google
        $(document).ready(function() {
            setTimeout(function() {
                $('#email').removeAttr('disabled');
                $('#senha').removeAttr('disabled');
            }, 100);
        });
        // Caso não tenha nenhum livro no catálogo, os formulários não são mostrados
        let $nothingToShow = $("#nothingToShow").html()
        if ($nothingToShow != undefined) {
            $("#home").css("display", "none")
            $("#search-area").css("display", "none")
            $("body").css("overflow", "hidden")
        }

        checkBtnRent();
        checkBtnPurchase();


        // Condições que ao load da página, desabilitam os botões caso o livro dito não tenha estoque ou
        // o usuário tenha inserido informações erradas
        // Variáveis
        let invalidPurchaseBookName = $("#nomeInvalidoCompra").html() !== undefined;
        let wrongPurchaseBookName = $("#nomeErradoCompra").html() !== undefined;

        let invalidRentBookName = $("#nomeInvalidoAluguel").html() !== undefined;
        let wrongRentBookName = $("#nomeErradoAluguel").html() !== undefined

        let noPurchaseStock = $("#semEstoqueCompra").html() !== undefined;
        let noRentStock = $("#semEstoqueAluguel").html() !== undefined;

        // Botões do formulário de aluguel
        if (wrongRentBookName || invalidRentBookName || noRentStock) {
            $("#btnAluguel").css("display", "none");
        }

        // Botões do formulário de compra
        if (wrongPurchaseBookName || invalidPurchaseBookName || noPurchaseStock) {
            $("#btnCompra").css("display", "none");
        }
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').on("click keydown", (e) => {
        if (e.which == 13 || e.type == 'click') {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        }
    });

    if ($("#quantidadeLivro").val() == 0) {
        $("#btnCompra").attr("disabled", "");
    }

    // Variáveis formulário de aluguel
    $rent = $("#rentPrice").text();
    $days = $("#dias").val();
    $bookRentedID = $("#bookId").val();
    // Variáveis formulário de compra
    $purchase = $("#price").text();
    $quantity = "<?php quantityBook() ?>";
    $bookPurchasedID = $("#bookPurchasedID").val();

    $botaoFinalizarPedido = $("#btn-submit");
    $showPrice = $('#showPrice');
    $showInformation = $('#showMoreInformations');
    $inputBookID = $("#auxiliarInput");

    $rentBook = $("#nomeLivroAlugado").val();
    $purchaseBook = $("#nomeLivroComprado").val();

    // Condições para cada opção do input select do modal (linha 331)
    $('#tipo-de-compra').change(function() {
        $valueSelect = $('#tipo-de-compra').val();
        $showPrice.css('display', 'block');

        // Opção 1
        if ($valueSelect == '---') {
            $botaoFinalizarPedido.attr("disabled", "");

            $showInformation.css('display', 'none');
            $("#showPrice").val("Por favor, selecione uma das opções");
        }

        // Opção 2
        if ($valueSelect == 'Aluguel') {
            $("#form-submit").attr("action", "../config/rent.php");
            $inputBookID.val($bookRentedID);

            if ($rent == '') {
                $botaoFinalizarPedido.attr("disabled", "");
                $showInformation.css('display', 'none');
                $showPrice.val("Calcule o preço antes de alugar o livro");
            } else {
                $botaoFinalizarPedido.removeAttr("disabled");
                $showPrice.val(`Esse é o preço do aluguel do livro "${$rentBook}": R$${$rent}`);
                $showInformation.css('display', 'block');
                $showInformation.val("O livro será alugado por: " + $days + " dia(s)") && $botaoFinalizarPedido.removeAttr("disabled");;
            }
        }

        // Opção 3
        if ($valueSelect == 'Compra') {
            $("#form-submit").attr("action", "../config/purchase.php");
            $inputBookID.val($bookPurchasedID);
            if ($purchase == '') {
                $botaoFinalizarPedido.attr("disabled", "");
                $showPrice.val("Calcule o preço antes de comprar o livro");
                $showInformation.css('display', 'none');
            } else {
                $botaoFinalizarPedido.removeAttr("disabled");
                $showPrice.val(`Esse é o preço do livro "${$purchaseBook}": R$${$purchase}`);
                $showInformation.css('display', 'block');
                $showInformation.val("Quantidade de livros a serem comprados: " + $quantity + " livro(s)") && $botaoFinalizarPedido.removeAttr("disabled");
            }
        }
    });

    // Funções que habilitam/desabilitam os botões
    function checkBtnRent() {
        if ($("#nomeLivroAlugado").val().length < 3 || $("#dias").val().length < 1) {
            $("#btnAluguel").attr("disabled", "");
            $("#calcularPrecoAluguel").attr("disabled", "");
            return;
        }
        $("#btnAluguel").removeAttr("disabled");
        $("#calcularPrecoAluguel").removeAttr("disabled");
    };

    function checkBtnPurchase() {
        if ($("#nomeLivroComprado").val().length < 3 || $("#quantidadeLivro").val().length < 1) {
            $("#btnCompra").attr("disabled", "");
            $("#btnCalculo").attr("disabled", "");
            return;
        }
        $("#btnCompra").removeAttr("disabled");
        $("#btnCalculo").removeAttr("disabled");
    };

    // Eventos nos botões de aluguel
    $("#nomeLivroAlugado").on("input", checkBtnRent);
    $("#dias").on("input", checkBtnRent);

    //Eventos nos botões de compra
    $("#nomeLivroComprado").on("input", checkBtnPurchase);
    $("#quantidadeLivro").on("input", checkBtnPurchase);

    $("#form-addBook").click(() => {
        if (confirm("Você será dimensionado para uma página na mesma janela")) {
            $("#form-addBook").attr("href", "./index.php#form");
        }
    });
    $("#catalog-home").click(() => {
        if (confirm("Voltar para a página inicial?")) {
            $("#catalog-home").attr("href", "./index.php");
        }
    });
</script>
<script src="../public/js/theme.js"></script>
<script src="../public/js/pace.js"></script>
<script src="../public/js/global.js"></script>

</html>