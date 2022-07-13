<?php
session_start();

if ((!isset($_SESSION['UsuarioNome']) == true) and (!isset($_SESSION['UsuarioSenha']) == true)) {
    echo "<script>alert('Você precisa estar logado para acessar a página!');
    window.location = '../login.php';</script>";
    exit;
}

if ($_SESSION['UsuarioID'] != 1) {
    echo "<script>alert('Você não possui direitos para acessar a página!'); window.location = 'catalog.php';</script>";
} else {
    if (!empty($_GET['id'])) {

        include_once('../config/config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM livro WHERE idLivro = $id";

        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $nameValue = $data['nome'];
                $yearValue = $data['ano'];
                $priceValue = $data['preco'];
                $quantityValue = $data['quantidade'];
            }
        } else {
            header('Location: catalog.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../public/icons/icon-header.png" />
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">

    <script src="../bootstrap/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Edição | Bibliozzin</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
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
                            <a href="catalog.php" class="nav-link">Voltar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><label for="darkSwitch" class="pt-2"><i class="fa-solid" id="labelDarkSwitch" tabindex="0" style="cursor: pointer;"></i></label></a>
                        </li>
                    </ul>
            </nav>
        </div>
    </header>
    <!-- /header -->

    <!-- Aqui, todos os values dos inputs são preenchidos com as variáveis criadas no inicio da página, que armazenam informações do livro a ser editado -->
    <div class="container mt-4" style="width:50vw;">
        <form action="../config/save.php" method="POST">
            <div class="form-title">
                <h1 class="text-center">Editar livro</h1>
            </div>
            <div class="form-group">
                <label for="nome">Nome do livro</label>
                <input type="text" value="<?php echo $nameValue ?>" name="nome" class="form-control" placeholder="Nome do livro" spellcheck="false">
            </div>
            <div class="form-group">
                <label for="ano">Ano do livro</label>
                <input type="number" value="<?php echo $yearValue ?>" name="ano" class="form-control" placeholder="Ano do livro">
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="preco">Preço</label>
                        <input type="number" value="<?php echo $priceValue ?>" name="preco" class="form-control pl-2" placeholder="Preço do livro">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" value="<?php echo $quantityValue ?>" name="quantidade" class="form-control pl-2" placeholder="Informe a quantidade">
                    </div>
                </div>
                <input type="hidden" name="idEdicao" value="<?php echo $id ?>">
            </div>
            <button type="submit" name="enviarEdicao" class="btn btn-success">Finalizar edição</button>
        </form>
    </div>

</body>
<script src="../public/js/global.js"></script>
<script src="../public/js/pace.js"></script>
<script src="../public/js/theme.js"></script>

</html>