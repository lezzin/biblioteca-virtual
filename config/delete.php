<?php
session_start();

if ((!isset($_SESSION['UsuarioNome']) == true) and (!isset($_SESSION['UsuarioSenha']) == true)) 
{
    echo "<script>alert('Você precisa estar logado para acessar a página!');
    window.location = '../login.php';</script>";
    exit;
}

if ($_SESSION['UsuarioID'] != 1) 
{
    echo "<script>alert('Você não possui direitos para realizar essa ação!');
        window.location = '../pages/catalog.php';</script>";
    exit;
}
else 
{

    include_once('config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM livro WHERE idLivro=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM livro WHERE idLivro = $id";
        $resultDelete = $conexao->query($sqlDelete);
    }
    echo "
    <script>alert('Deletado com sucesso.');
    window.location = '../pages/catalog.php';
    </script>";
}
