<?php

if (isset($_POST['submit'])) {
    include_once('../config/config.php');

    // Variáveis do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se há uma conta com o email inserido
    $verifyEmail = "SELECT `email` FROM `cliente` WHERE `email` = '$email'";
    $verification = $conexao->query($verifyEmail);

    if ($verification->num_rows > 0) {
        echo "
        <script>
        alert('Já existe uma conta cadastrada com esse email!');
        </script>";
    } else {
        // São armazenados no banco de dados os dados inseridos no formulário
        $insertDatas = "INSERT INTO cliente(nome, CPF, telefone, email, senha) VALUES ('$nome', '$cpf', '$telefone', '$email','$senha')";
        $result = $conexao->query($insertDatas);
        echo "
        <script>
        alert('Cadastrado com sucesso! Agora, basta inserir os dados novamente no formulário de login para entrar no site');
        window.location = '../login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aqui é o formulário de cadastro caso o usuário não possui uma conta">
    <meta name="author" content="Leandro Adrian da Silva">

    <link rel="icon" type="image/png" href="../public/icons/icon-header.png" />
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/bootstrap.min.css"></script>
    <script src="../public/js/jquery.mask.min.js"></script>

    <title>Cadastro | Bibliozzin</title>
</head>

<body style="font-family: 'Source Sans Pro', sans-serif;height:100vh;" class="d-flex flex-column justify-content-between">
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
    <header class="bg-primary">
        <div class="container">
            <nav class=" navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" target="_blank" tabindex="0" id="github-link"><img src="../public/icons/icon-header.png"><span class="p-1">Bibliozzin</span></a>
                <button class="navbar-toggler border-0" style="outline: none;" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center justify-content-end" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link" href="../login.php">Voltar</a>
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

    <!-- formulario de cadastro -->
    <h1 class="text-center mt-5">Cadastro</h1>
    <div class="container pt-2 pb-5 mb-md-0 d-flex justify-content-center">
        <form method="POST" style="font-size:1.3em">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Seu nome" required>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Seu e-mail" required disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" name="telefone" class="form-control" id="telefone" placeholder="Telefone" required>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Seu CPF" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group d-flex flex-column">
                        <label for="senha" id="status-senha">Senha</label>
                        <input type="password" name="senha" class="form-control inputSenha" id="senha" placeholder="Sua senha" minlength="5" maxlength="12" required disabled>
                        <small id="nCaracteres" style="font-size: .8rem;" class="pt-1"></small>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="senha">Confirmar senha</label>
                        <input type="password" name="senha" class="form-control inputSenha" id="confirmar_senha" placeholder="Insira a senha novamente" minlength="5" maxlength="12" required disabled>
                        <small id="nCaracteres2" style="font-size: .8rem;"></small>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" class="btn btn-primary">Cadastrar-se</button>
                <button type="button" id="botao-olho" tabindex="0" class="btn btn-light ml-1"><img width="16" height="16" id="exibe" src="../public/icons/eye.svg"></button>
            </div>
            <a tabindex="0" id="generateBtn" class="text-primary font-weight-bold" style="font-size: .7em;text-decoration:none; cursor:pointer;">Gerar senha</a>
        </form>
    </div>
    <!-- /formulario de cadastro -->

    <!-- footer -->
    <footer class="p-2 text-center">
        <ul class=" nav d-flex justify-content-center align-items-center p-1">
            <li class="nav-item"><a href="https://www.instagram.com/leandroadrian_/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-instagram" style="font-size: 1.4em;"></i></a>
            </li>
            <li class="nav-item"><a href="https://github.com/lezzin" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-github" style="font-size: 1.4em;"></i></a>
            </li>
            <li class="nav-item"><a href="https://www.linkedin.com/in/leandro-adrian/" target="_blank" class="nav-link p-1 text-dark"><i class="fa-brands fa-linkedin" style="font-size: 1.4em;"></i></a>
            </li>
        </ul>
        <span class="text-center">&copy Leandro Adrian da Silva, 2022</span>
    </footer>
    <!-- /footer -->
</body>

<script type="text/javascript">
    // Gerador de senhas
    $("#generateBtn").on("click keypress", function(e) {
        if (e.which == 13 || e.type == 'click') {
            passwordLength = prompt("Insira o tamanho da senha (entre 5 e 12):");

            if (passwordLength == "") {} else {
                let i, password, charset, length;
                charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                length = charset.length;
                password = "";

                if (passwordLength < 5 || passwordLength > 12) {
                    alert("Insira um número maior que 4 e menor que 13")
                    return;
                }

                for (let i = 0; i < passwordLength; i++) {
                    password += charset.charAt(Math.floor(Math.random() * length))
                }
                if (passwordLength == "") {} else {
                    alert("Senha gerada com sucesso");
                    $("#senha").val(password);
                    $("#confirmar_senha").val(password);
                    $senhas.attr("type", "text");
                }
            }
        }
    });

    // Evitar o autocomplete de formulários do google
    $(document).ready(function() {
        setTimeout(function() {
            $('#email').removeAttr('disabled');
            $('#senha').removeAttr('disabled');
            $('#confirmar_senha').removeAttr('disabled');
        }, 100);

        // Máscaras para os inputs
        $cpfInput = $("#cpf");
        $telephoneInput = $("#telefone");

        $cpfInput.mask("000.000.000-00");
        $telephoneInput.mask("(00) 00000-0000")

    });

    // Aqui há o uso das expressões regulares para verificar a força da senha
    function verificaForcaSenha() {
        var numeros = /([0-9])/;
        var alfabeto = /([a-zA-Z])/;
        var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        $('#status-senha').html("Senha");
        if ($('#senha').val().length < 6) {
            $('#status-senha').html($('#status-senha').html() + " <span style='color:red'>fraca<span>");
        } else {
            if ($('#senha').val().match(numeros) && $('#senha').val().match(alfabeto) && $('#senha').val().match(chEspeciais)) {
                $('#status-senha').html($('#status-senha').html() + " <span style='color:green'>forte<span>");
            } else {
                $('#status-senha').html($('#status-senha').html() + " <span style='color:orange'>média<span>");
            }
        }
    };
    // Eventos
    $("#senha").on('input', verificaForcaSenha);
    $("#senha").on('blur focusout', () => {
        $("#status-senha").html("Senha");
    });

    var senha = document.querySelector("#senha");
    var confirmarSenha = document.querySelector("#confirmar_senha");

    const ValidarSenha = () => {
        if (senha.value != confirmarSenha.value) {
            confirmarSenha.setCustomValidity("Senhas diferentes!");
        } else {
            confirmarSenha.setCustomValidity('');
        }
    };
    confirmarSenha.onchange = ValidarSenha;

    // Contador de caracteres
    $("#senha").on('input', () => {
        let nCaracteres = $("#senha").val().length;
        $("#nCaracteres").html(`Quantidade de caracteres: ${nCaracteres}`);
    });
    $("#confirmar_senha").on('input', () => {
        let nCaracteres2 = $("#confirmar_senha").val().length;
        $("#nCaracteres2").html(`Quantidade de caracteres: ${nCaracteres2}`);
    });

    // Exibe/oculta as senhas
    var $botaoOlho = $("#botao-olho");
    var $olho = $("#exibe");
    var $senhas = $(".inputSenha");
    const changeEye = () => {
        if ($senhas.attr('type') == 'password') {
            $olho.attr("src", "../public/icons/eye-slash.svg");
            $senhas.attr("type", "text");
        } else {
            $olho.attr("src", "../public/icons/eye.svg");
            $senhas.attr('type', 'password');
        }
    }

    // Eventos
    $botaoOlho.on('keydown', (e) => {
        if (e.which == 13) {
            changeEye;
        }
    });
    $botaoOlho.click(changeEye);
</script>
<script src="../public/js/global.js"></script>
<script src="../public/js/pace.js"></script>
<script src="../public/js/theme.js"></script>

</html>