<?php

// Dados do servidor SQL, geralmente estão na página inicial do aplicativo
$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName  = 'biblioteca';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


// Verificação para ver se há a conexão

// if ($conexao->connect_errno) 
// {
//     echo "Erro";
// } 
// else 
// {
//     echo "Conectado";
// }
