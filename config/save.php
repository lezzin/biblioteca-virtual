<?php

include_once('../config/config.php');

if (isset($_POST['enviarEdicao'])) {

    $idLivro = $_POST['idEdicao'];
    $nome = $_POST['nome'];
    $ano = $_POST['ano'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_FILES['imagem']['name'];
    $sqlUpdate = "UPDATE livro SET nome = '$nome', ano = '$ano', preco = '$preco', quantidade = '$quantidade', imagem = '$imagem' WHERE idLivro='$idLivro'";

    $updateDatabase = $conexao->query($sqlUpdate);
    echo "
    <script>alert('Editado com sucesso!');
    window.location = '../pages/catalog.php?filter=semfiltro&filtrar=';
    </script>";
}
