<?php

include_once('../config/config.php');
session_start();

if ((!isset($_SESSION['UsuarioNome']) == true) and (!isset($_SESSION['UsuarioSenha']) == true)) {
    echo "<script>alert('Você precisa estar logado para acessar a página!');
    window.location = '../login.php';</script>";
    exit;
};

$logado = $_SESSION['UsuarioNome'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Leandro Adrian da Silva">
    <meta name="description" content="Aqui é onde aparecerão o resultado da busca feita na barra de pesquisa do catálogo">

    <link rel="icon" type="image/png" href="../public/icons/icon-header.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js" defer></script>

    <title>Resultados da pesquisa</title>
</head>

<body style="font-family: 'Source Sans Pro', sans-serif;">
    <input type="checkbox" id="darkSwitch" style="display: none;">

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
    <header class="bg-light shadow-sm sticky-top w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light" style="width: auto;">
                <a class="navbar-brand" id="github-link" tabindex="0" target="_blank"><img src="../public/icons/icon-header.png" loading="lazy"><span class="p-1" style="font-family:'Roboto', sans-serif;">Bibliozzin</span></a>
                <button class="navbar-toggler border-0" style="outline: none;" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center justify-content-end" style="width: 100%;">
                        <li class="nav-item">
                            <a href="catalog.php" class="nav-link">Voltar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="catalog.php">Catálogo</a>
                        </li>
                        <li class="nav-item mr-2">
                            <a class="nav-link"><label for="darkSwitch" class="pt-2"><i class="fa-solid" id="labelDarkSwitch" tabindex="0" style="cursor: pointer;"></i></label></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- /header -->

    <!-- resultados da pesquisa -->
    <div class="container mt-5  mb-5" id="home">
        <?php

        // Se existe o botão pesquisar, que está na página do catálogo e se o valor do input é diferente de nada (espaços em branco)
        if (isset($_POST['pesquisar']) && trim($_POST['search']) !== "") {

            // Valor do input (nome do livro)
            $bookName = $_POST['search'];
            // Pesquisa do nome do livro no banco de dados
            // % identifica se a palavra descrita no input está no fim, meio ou começo do nome de um livro, assim, podem haver mais de um resultado
            $search = "SELECT * FROM livro WHERE nome LIKE '%$bookName%' ORDER BY nome";
            $searchResults = $conexao->query($search);
            $rowsOfData = mysqli_num_rows($searchResults);

            // Caso não exista nenhum livro com o nome pesquisado
            if ($rowsOfData == 0) {
                echo "<h3 class='text-center text-danger'>Não houve nenhum resultado para a busca.</h3>";
                // Caso tenha, será exibido a quantidade de resultados
            } else if ($rowsOfData == 1) {
                echo "<h3 class='text-center text-danger'>Foi encontrado " . $rowsOfData . " resultado para a busca.</h3>";
            } else {
                echo "<h3 class='text-center text-danger'>Foram encontrados " . $rowsOfData . " resultados para a busca.</h3>";
            }
            // Caso o input de pesquisa seja nulo ou tenha espaços em branco, o usuário é movido novamente para o catálogo
        } else {
            echo "<script>alert('Preencha o campo de pesquisa.');
                window.location = 'catalog.php';
            </script>;";
            exit;
        }
        ?>
        <span class="text-info d-flex justify-content-center" id="message"></span>
        <div class="row d-flex justify-content-center align-items-center mt-5" id="container-cards">
            <?php
            // Aqui é onde são mostrados os resultados da pesquisa
            // No caso, é criado um card com as informações do livro, mas poderia ser uma lista ou tabela
            while ($db = mysqli_fetch_array($searchResults)) 
            {
                if ($db['quantidade'] == 0) 
                {
                    echo "
                    <div class='card m-1  rounded' style='width: 16rem; height: 16rem;' data-aos='fade-up' id='card-book'>
                        <div class='card-body d-flex justify-content-center align-items-center flex-column text-center'>
                            <h5 class='card-title' tabindex='0'>" . $db['nome'] . "</h5>
                            Ano de lançamento: "  . $db['ano'] . "<br>
                            Preço do livro: R$" . str_replace('.', ',', $db['preco']) . "<br>
                            <p class='text-danger font-weight-bold'>Indisponível</p>                        
                            <a href='../config/delete.php?id=$db[idLivro]'><img src='../public/icons/trash-can-solid.svg' width='16' height='16' loading='lazy'></a>
                        </div>
                    </div>";
                } 
                else 
                {
                    echo "
                    <div class='card m-1  rounded' style='width: 16rem; height: 16rem;' data-aos='fade-up' id='card-book'>
                        <div class='card-body d-flex justify-content-center align-items-center flex-column text-center'>
                            <h5 class='card-title' tabindex='0'>" . $db['nome'] . "</h5>
                            Ano de lançamento: " . $db['ano'] . "<br>
                            Preço do livro: R$" . str_replace('.', ',', $db['preco']) . "<br>
                            Disponíveis: " . $db['quantidade'] . "<br>
                            <div class='btn-group pt-1 pb-1' role='group'>
                                <a href='#alugarLivro' class='btn btn-secondary'>Alugar</a>
                                <a href='#comprarLivro' class='btn btn-secondary'>Comprar</a>
                            </div>
                            <div class='d-flex justify-content-around mt-1 w-50'>
                                <a href='../config/delete.php?id=$db[idLivro]'><img src='../public/icons/trash-can-solid.svg' width='16' height='16' loading='lazy'></a>
                                <a href='edit.php?id=$db[idLivro]'><img src='../public/icons/pencil.svg' width='16' height='16' loading='lazy'></a>
                            </div>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-light p-2 d-flex flex-column justify-content-center align-items-center shadow-sm" id="footer">
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

</body>

<script>
    // Caso não tenha nenhum resultado, em 5 segundos o usuário é movido para a página de catálogo
    resultNumber = "<?php echo $rowsOfData; ?>";
    timer = 5;
    message = document.querySelector("#message");
    $(document).ready(() => {
        if (resultNumber == 0 || resultNumber == '') {
            $("#footer").removeClass("d-flex");
            $("#footer").addClass("d-none");
            setInterval(() => {
                message.innerHTML = `Você será redimensionado em: <b>${timer--}</b>`;
            }, 1000);
            setTimeout(() => {
                window.location.assign("catalog.php")
            }, 5000)
        };
    });
</script>
<script src="../public/js/global.js"></script>
<script src="../public/js/pace.js"></script>
<script src="../public/js/theme.js"></script>

</html>