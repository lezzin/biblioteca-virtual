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
        // Calcula as datas a serem inseridas no banco de dados, sendo uma o dia atual e a outra os dias que o usuário ficará com o livro
        $currentDate =  date('Y-m-d');
        // Adição dos dias em que o usuário ficará com o livro, com o formato adequado, sem letras
        $daysWithBook = preg_replace('/[^\d]/', '', $_POST['additional']);

        $deliveryDate =  date('Y-m-d', strtotime("+" . $daysWithBook . " days"));

        // Formatação do preço para ser inserido corretamente no banco de dados
        // Aqui, foi usada uma expressão regular para excluir as palavras
        $noWord = preg_replace('/[^\d\,]/', '', $_POST['precoConta']);
        // E aqui um comando para trocar a vírgula por ponto
        $price = str_replace(",", ".", $noWord);
        
        // Comando para pegar o id do livro alugado/comprado
        $bookIdReference = $_POST['livro'];
        $searchCommand = "SELECT idLivro FROM livro WHERE idLivro LIKE '$bookIdReference'";
        $searchResult = $conexao->query($searchCommand);

        if($searchResult->num_rows==0)
        {
            echo "
            <script>
            alert('Não existe livro com esse nome');
            window.location='../pages/catalog.php';
            </script>";        
        }
        else
        {
            $bookIDDatas = mysqli_fetch_assoc($searchResult);
            $bookID = $bookIDDatas['idLivro'];
            $insertDatas = "INSERT INTO emprestimo(inicio, termino, preco, fk_livro, fk_cliente) VALUES ('$currentDate', '$deliveryDate', $price, $bookID, $clientID)";
            $insertResult = $conexao->query($insertDatas);
            echo "
            <script>alert('Ação realizada com sucesso');
            window.location='../pages/catalog.php';
            </script>";
        }   
    }
}
