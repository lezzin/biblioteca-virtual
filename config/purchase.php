<?php

session_start();

if (isset($_POST['enviarForm']))
{

    include_once('config.php');

    // Verificando se os dados existem no banco de dados
    $userEmail = $_POST['email-usuario'];
    $userPassword = $_POST['senha-usuario'];
    $userCpf = $_POST['cpf-usuario'];
    $datas = "SELECT `idCliente` FROM `cliente` WHERE (`email` = '$userEmail') AND (`senha` = $userPassword) AND (`CPF`=$userCpf)";
    $result = $conexao->query($datas);
    $clientID = $_SESSION['UsuarioID'];

    if ($result->num_rows == 0) 
    {
        echo "<script>alert('Não existe usuário com os dados especificados. Verifique se você inseriu os dados corretamente.'); window.location='../pages/catalog.php'</script>";
    }
    else
    {
        // Formatação do preço para ser inserido corretamente no banco de dados
        // Aqui, foi usada uma expressão regular para excluir as palavras
        $noWord = preg_replace('/[^\d\,]/', '', $_POST['precoConta']);
        // E aqui um comando para trocar a vírgula por ponto
        $price = str_replace(",", ".", $noWord);

        $quantity = preg_replace('/[^\d]/', '', $_POST['additional']);

        // Comando para pegar o id do livro alugado/comprado
        $bookIdReference = $_POST['livro'];
        $searchCommand = "SELECT idLivro FROM livro WHERE idLivro LIKE '$bookIdReference'";
        $searchResult = $conexao->query($searchCommand);
        $bookIDDatas = mysqli_fetch_assoc($searchResult);
        $bookID = $bookIDDatas['idLivro'];

        // Função para diminuir a quantidade de livros no banco de dados, de acordo com a quantidade escolhida pelo cliente
        $sqlUpdate = "UPDATE livro SET quantidade = quantidade-$quantity where idLivro = $bookID";
        $updateResult = $conexao->query($sqlUpdate);

        $insertDatas = "INSERT INTO compra(preco, quantidade, fk_livro, fk_cliente) VALUES ('$price', '$quantity', $bookID, '$clientID')";
        $insertResult = $conexao->query($insertDatas);
        echo "<script>alert('Ação realizada com sucesso');
        window.location='../pages/catalog.php';
        </script>";
        exit;
    }
}
